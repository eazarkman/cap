<?php

namespace App\Http\Controllers;

use App\User;
use App\Storis;
use App\Bread;
use App\Customer;
use App\Progressive;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
class SalesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Log::useDailyFiles(storage_path().'/creditapp/debug.log');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        return view('credit',compact('users'));
    }

    public function confirm()
    {
        $users = User::all();
        return view('confirm',compact('users'));
    }

    public function checkapp(Request $request)
    {
        $fullname = $address = $city = $state = $zip = $phone = $email = $address2 = '';
        $customer = new Customer();
        $storis = new Storis();
        if($request->exists('customer_id')){
            $insert_val = [
                'customer_id'=>$request->get('customer_id'),
                'source'=>$request->get('source'),
                'language'=>$request->get('language'),
                'username'=>Auth::user()->email,
                'admin_name'=>Auth::user()->name
            ];
            $insertedId = DB::table('log')->insertGetId($insert_val);
            if ( $request->get('source') == 'bread' && $request->get('language') != 'english' ){
                return response()->json(['success'=>false,'status'=>'not supported','error'=>true,'msg'=>'Bread only prefer english language']);
            }
           $customer_data = $customer->getCustomerData(null,$request->get('customer_id'),$request->get('source'));

        }else {
            $customer_data = $customer->getCustomerData($request->get('appnumber'),null,$request->get('source'));
        }
        if($customer_data['success']) {
            if (isset($customer_data['storis'])) {
                return response()->json($customer_data['result']);
            } else {
                return response()->json($customer_data['bread_package']);
            }
        }else{
            return response()->json($customer_data);
        }
        //return response()->json($result);
    }

    public function saveapp(Request $request)
    {
        $table_data = DB::connection('defi')->select('show columns from Customers');
        $insert_value = $this->createDBreadyData($table_data,$request->all());
        $storis = new Storis();
        $customer_response = $storis->createCustomer($insert_value);
        if(is_array($customer_response)) {
            if(isset($customer_response['success'])&&$customer_response['success']) {
                $insert_value['custid'] = $customer_response['customer_id'];
            }else{
                if(isset($customer_response['message'])) {
                    return response()->json(['success' => false, 'error' => true, 'msg' => $customer_response['message']]);
                }
            }
        }
        if (isset($insert_value['ssn'])){
            $insert_value['ssn'] = Crypt::encryptString($insert_value['ssn']);
        }
        if (isset($insert_value['dob'])){
            $insert_value['dob'] = date('Y-m-d',strtotime($insert_value['dob']));
        }
        $inserted_record = DB::connection('defi')->table('Customers')->insertGetId($insert_value);
        if($inserted_record) {
            return response()->json(['success'=>true,'error'=>false,'appId'=>$inserted_record,'msg'=>'Record Successfully saved. Id : '.$inserted_record]);
        }else{
            return response()->json(['success'=>false,'error'=>true,'msg'=>'Customer Data did not get saved']);
        }
    }

    public function getorder(Request $request){
        $storis = new Storis();
        $order_response = $storis->getOrder($request->get('order_id'),$request->get('customer_id'));
        if(is_array($order_response)) {
            if(isset($order_response['success'])&&$order_response['success']) {
                $order = $order_response['order'];
                $items = [];
                foreach ($order['lineItems'] as $item){
                    $items[] = [
                        'name'=>$item['description'],
                        'price'=> round($item['price']/$item['quantity'],2)*100,
                        'sku'=> $item['id'],
                        'quantity'=> $item['quantity'],
                        //'quantity'=> 1,
                        'detailUrl'=> '[REPLACEMEWITHAREALURL]'
                    ] ;
                }
                if ($order['orderTotals']['delivery']>0){
                    $items[] = [
                        'name'=>'Delivery Charge',
                        'price'=> $order['orderTotals']['delivery']*100,
                        'sku'=> 'delivery',
                        'quantity'=> 1,
                        'detailUrl'=> '[REPLACEMEWITHAREALURL]'
                    ];
                }
                if ($order['orderTotals']['install']>0){
                    $items[] = [
                        'name'=>'Installation Charge',
                        'price'=> $order['orderTotals']['install']*100,
                        'sku'=> 'installation',
                        'quantity'=> 1,
                        'detailUrl'=> '[REPLACEMEWITHAREALURL]'
                    ];
                }
                $response = ['items'=>$items,'tax'=>$order['orderTotals']['tax'],'delivery'=>$order['orderTotals']['delivery']];
                return response()->json(['success' => true, 'error' => false, 'msg' => '','orderInfo'=>$response]);
            }else{
                if(isset($order_response['message'])) {
                    return response()->json(['success' => false, 'error' => true, 'msg' => $order_response['message']]);
                }
            }
        }
    }
    public function runProgressive(Request $request){
        Log::info('Initiated');
        $data = $request->all();
        $customer = new Customer();
        $customer_data = $customer->getCustomerData(null,$request->get('customer_id'),'customer');
        Log::info('Get Customer Data');
        Log::info($customer_data);
        //print_r($customer_data);
        if($customer_data['success']) {
            Log::info("Successfully for the customer Data");
            if (isset($customer_data['storis'])) {
                return response()->json($customer_data['result']);
            } else {
                $app = $customer_data['application'];
                if($app->home_phone){
                    $phone = $app->home_phone;
                }elseif($app->cell_phone){
                    $phone = $app->cell_phone;
                }else{
                    $phone = $app->work_phone;
                }
                /*if (count($customer_data['employers'])>0){
                    $empl = $customer_data['employers'][0];
                    $data['HireDate'] = $empl->HireDate;
                    $data['MonthlyGrossIncome'] = $empl->MonthlyGrossIncome?$empl->MonthlyGrossIncome:0;
                    $data['LastPayDate'] = $empl->LastPayDate;
                    $data['PayFrequency'] = $empl->PayFrequency;
                }*/
                $data = array_merge($data,[
                    'FirstName'=>$app->first_name
                    ,'LastName'=>$app->last_name
                    ,'HomePhone'=>$phone
                    ,'StreetAddress1'=>$customer_data['bread_package']['address']
                    ,'StreetAddress2'=>$customer_data['bread_package']['address2']
                    ,'City'=>$customer_data['bread_package']['city']
                    ,'State'=>$customer_data['bread_package']['state']
                    ,'Zip'=>$customer_data['bread_package']['zip']
                ]);
            }
            Log::info($data);
            Log::info("Staring progressive");
            $progressive = new Progressive();
            $validateABA = $progressive->validateABA($data['ABARoutingNumber']);
            if($validateABA['success']&&$validateABA['result']['IsValid']){
                Log::info("Valid Bank routing number");
                if ($request->session()->has('progressive_account_id')) {
                    Log::info("Account Id from Session");
                    $account_id = $request->session()->get('progressive_account_id');;
                    $invoice_request = $progressive->createInvoice($request->get('orderNumber'), $request->get('customer_id'), $account_id);
                    if($invoice_request['success']){
                        $request->session()->forget('progressive_account_id');
                    }
                    Log::info($invoice_request);
                    return response()->json($invoice_request);
                }else {
                    /*$data['FirstName'] = 'Any';
                    $data['LastName'] = 'things';
                    $data['HomePhone'] = '8885554587';
                    $data['StreetAddress1'] = '456 Main St';*/
                    $data['HireDate'] = date('Y-m-d', strtotime($data['HireDate']));
                    $data['LastPayDate'] = date('Y-m-d', strtotime($data['LastPayDate']));
                    $data['BirthDate'] = date('Y-m-d', strtotime($data['BirthDate']));
                    $data['DateAccountOpened'] = date('Y-m-d', strtotime($data['DateAccountOpened']));
                    $data['SocialSecurityNumber'] = str_replace("-", "", $data['SocialSecurityNumber']);
                    //$data['PayFrequency'] = 'MONTHLY';
                    Log::info($data);
                    $progressive_request = $progressive->SubmitPartialApplication($data);
                    Log::info($progressive_request);
                    if ($progressive_request['success']) {
                        // Make the invoice
                        $account_id = $progressive_request['result']['AccountNumber'];
                        $request->session()->put('progressive_account_id', $account_id);
                        $invoice_request = $progressive->createInvoice($request->get('orderNumber'), $request->get('customer_id'), $account_id);
                        if($invoice_request['success']){
                            $request->session()->forget('progressive_account_id');
                        }
                        Log::info($invoice_request);
                        return response()->json($invoice_request);
                    } else {
                        return response()->json($progressive_request);
                    }
                }
            }else{
                Log::info($validateABA);
                return response()->json(["success"=>false,"error"=>true,"msg"=>"Invalid Bank account information"]);
            }
        }else{
            return response()->json($customer_data);
        }

    }
    public function authorizebread(Request $request){
        $bread = new Bread();
        return response()->json($bread->authorizeTransaction($request->get('transaction_id'),$request->get('order_id')));
    }
    //TODO :: This function can be used to validate and prompt as suggestion but not have effect on the source
    protected function getSource($score){
        // TODO :: Add more complex rules when available
        if($score>=720){
            $source = 'sw';
        }else{
            $source = 'bread';
        }
        return $source;
    }
    protected function createDBreadyData($table_data,$request_data){
        $final_data = [];
        foreach ($table_data as $field){
            if(array_key_exists($field->Field,$request_data)){
                $final_data[$field->Field] = $request_data[$field->Field];
            }
        }
        return $final_data;
    }
}
