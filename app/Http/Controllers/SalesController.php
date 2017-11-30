<?php

namespace App\Http\Controllers;

use App\User;
use App\Storis;
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
        if($request->exists('customer_id')){
            if ( $request->get('source') == 'bread' && $request->get('language') != 'english' ){
                return response()->json(['success'=>false,'status'=>'not supported','error'=>true,'msg'=>'Bread only prefer english language']);
            }
            $insert_val = [
                'customer_id'=>$request->get('customer_id'),
                'source'=>$request->get('source'),
                'language'=>$request->get('language'),
                'username'=>Auth::user()->email,
                'admin_name'=>Auth::user()->name
            ];
            $insertedId = DB::table('log')->insertGetId($insert_val);
            $applications = DB::connection('defi')->select('select * from Customers where custid = :id', ['id' => $request->get('customer_id')]);
            if(count($applications)==0){
                $storis = new Storis();
                $customer_response = $storis->getCustomer($request->get('customer_id'));
                if($customer_response['success']){
                    $customer = $customer_response['customer'];
                    $fullname = $customer['fullName'];
                    $address = $customer['billingAddress']['address1'];
                    $address2 = $customer['billingAddress']['address2'];
                    $city = $customer['billingAddress']['city'];
                    $state = $customer['billingAddress']['state'];
                    $zip = $customer['billingAddress']['zipCode'];
                    foreach ($customer['phones'] as $phonearray){
                        $phnumber = '';
                        if($phonearray['phoneType']=='Mobile'){
                            $phnumber = $phonearray['number'];
                        }elseif($phonearray['phoneType']=='Home'){
                            $phnumber = $phonearray['number'];
                        }else{
                            $phnumber = $phonearray['number'];
                        }
                    }
                    $phone = $phnumber;
                    $email = $customer['emailAddress'];
                }else {
                    return response()->json(['showapplicaiton' => true]);
                }
            }
        }else {
            $applications = DB::connection('defi')->select('select * from Customers where id = :id', ['id' => $request->get('appnumber')]);
        }

        foreach ($applications as $application)
        {
           $fullname = $application->firstname." ".$application->lastname;
           $address = $application->street_number." ".$application->street_name." ".$application->street_type;
           $address2 = $application->apt_number;
            $city = $application->city;
           $state = $application->state;
           $zip = $application->zipcode;
           if($application->varphone){
               $phone = $application->varphone;
           }elseif ($application->homephone){
               $phone = $application->homephone;
           }else{
               $phone = $application->workphone;
           }
           $email = $application->email;

        }

        $result = ['funame' => trim($fullname)?$fullname:"FirstName LastName"
                    , 'address'=> trim($address)?$address:"123 Please fill"
                    , 'address2'=>$address2
                    , 'zip'=>$zip?$zip:"12345"
                    , 'city'=>$city?$city:"City Please"
                    , 'state' => $state?$state:"CA"
                    , 'phone' => $phone?$phone:"0000000000"
                    , 'email' => $email?$email:""
                    , 'source' => $request->get('source')
                    , 'showapplicaiton' => false
                ];

        //$result = ['status'=>'not found'];
        return response()->json($result);
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
                        'price'=> $item['price']*100,
                        'sku'=> $item['id'],
                        'quantity'=> $item['quantity'],
                        'detailUrl'=> '[REPLACEMEWITHAREALURL]'
                    ] ;
                }
                $response = ['items'=>$items,'tax'=>$order['orderTotals']['tax']];
                return response()->json(['success' => true, 'error' => false, 'msg' => '','orderInfo'=>$response]);
            }else{
                if(isset($order_response['message'])) {
                    return response()->json(['success' => false, 'error' => true, 'msg' => $order_response['message']]);
                }
            }
        }
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
