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
use League\Flysystem\Exception;
use App\Progressive;
class CreditappController extends Controller
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
        return view('bread',compact('users'));
    }

    public function save(Request $request){
        $customer_table_data = DB::connection()->select('show columns from customer');
        $customer_value = $this->createDBreadyData($customer_table_data,$request->all());
        $address_table_data = DB::connection()->select('show columns from address');
        $address_value = $this->createDBreadyData($address_table_data,$request->all());
        $storis = new Storis();
        $storis_data = array_merge($customer_value,$address_value);
        $customer_response = $storis->createCustomer($storis_data);
        if(is_array($customer_response)) {
            if(isset($customer_response['success'])&&$customer_response['success']) {
                $customer_value['storis_cust_id'] = $customer_response['customer_id'];
            }else{
                if(isset($customer_response['message'])) {
                    return response()->json(['success' => false, 'error' => true, 'msg' => $customer_response['message']]);
                }
            }
        }
        if (isset($customer_value['ssn'])){
            $customer_value['ssn'] = Crypt::encryptString($customer_value['ssn']);
        }
        if (isset($customer_value['dob'])){
            $customer_value['dob'] = date('Y-m-d',strtotime($customer_value['dob']));
        }
        try {
            $inserted_record = DB::connection()->table('customer')->insertGetId($customer_value);
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => true, 'msg' => $e->getMessage()]);
        }
        try {
            $address_value['customer_id'] = $inserted_record;
            $address_inserted_record = DB::connection()->table('address')->insertGetId($address_value);
        }catch (Exception $e){
            return response()->json(['success' => false, 'error' => true, 'msg' => $e->getMessage()]);
        }
        try {
            $insert_val = [
                'customer_id' => $customer_value['storis_cust_id'],
                'source' => 'Bread',
                'language' => $request->get('preferred_language'),
                'username' => Auth::user()->email,
                'admin_name' => Auth::user()->name
            ];
            $insertedId = DB::table('log')->insertGetId($insert_val);
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => true, 'msg' => $e->getMessage()]);
        }
        $fullname = $storis_data['first_name']." ".$storis_data['last_name'];
        $address = $storis_data['street_number']." ".$storis_data['street_name']." ".$storis_data['street_type'];
        $address2 = $storis_data['apt_number'];
        $city = $storis_data['city'];
        $state = $storis_data['state'];
        $zip = $storis_data['zip'];
        $phone = false;
        if(isset($storis_data['cell_phone'])){
            $phone = $storis_data['cell_phone'];
        }elseif(isset($storis_data['home_phone'])){
            $phone = $storis_data['home_phone'];
        }else{
            $phone = $storis_data['work_phone'];
        }
        $result = ['funame' => trim($fullname)?$fullname:"FirstName LastName"
            , 'customer_id'=> $customer_value['storis_cust_id']
            , 'address'=> trim($address)?$address:"123 Please fill"
            , 'address2'=>$address2
            , 'zip'=>$zip?$zip:"12345"
            , 'city'=>$city?$city:"City Please"
            , 'state' => $state?$state:"CA"
            , 'phone' => $phone?$phone:"0000000000"
            , 'email' => $storis_data['email']?$storis_data['email']:""
            , 'source' => 'bread'
            , 'showapplicaiton' => false
        ];
        return [
            'success'=>true,
            'error'=> false,
            'storis'=>true,
            'result'=>$result
        ];
    }

    public function progressive(){
        $progressive =  new Progressive();
        print_r($progressive->validateABA('021000128'));
        //print_r($progressive->SubmitPartialApplication(['test'=>'']));

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

