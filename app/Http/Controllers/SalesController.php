<?php

namespace App\Http\Controllers;

use App\User;
use App\Storis;
use App\Bread;
use App\Customer;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
           $customer_data = $customer->getCustomerData(null,$request->get('customer_id'),$request->get('source'),$storis);

        }else {
            $customer_data = $customer->getCustomerData($request->get('appnumber'),null,$request->get('source'),$storis);
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
