<?php

namespace App\Http\Controllers;

use App\User;
use App\Storis;
use Illuminate\Http\Request;
use DB;
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
        return view('sales',compact('users'));
    }

    public function confirm()
    {
        $users = User::all();
        return view('confirm',compact('users'));
    }

    public function checkapp(Request $request)
    {
        if($request->exists('customer_id')){
            $applications = DB::connection('defi')->select('select * from Customers where custid = :id', ['id' => $request->get('customer_id')]);
            if(count($applications)==0){
                return response()->json(['showapplicaiton'=>true]);
            }
        }else {
            $applications = DB::connection('defi')->select('select * from Customers where id = :id', ['id' => $request->get('appnumber')]);
        }

        $fullname = $address = $city = $state = $zip = $phone = $email = '';
        foreach ($applications as $application)
        {
           $fullname = $application->firstname." ".$application->lastname;
           $address = $application->street_number." ".$application->street_name." ".$application->street_type;
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
                    , 'address2'=>''
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
