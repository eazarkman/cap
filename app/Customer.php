<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Storis;
use League\Flysystem\Exception;

class Customer extends Model
{
    public function getCustomerData($app_id = null,$customer_id = '' , $source){
        $storis = new Storis();
        if(!$app_id && !$customer_id){
            return ['success'=>false, 'error'=>true,'msg'=>'Please provide either customer id or app id'];
        }
        if($app_id){
            $applications = DB::connection()->select('select * from customer where app_id = :id order by id DESC limit 1', ['id' => $app_id]);
        }elseif ($customer_id){
            $applications = DB::connection()->select('select * from customer where storis_cust_id = :id  order by id DESC limit 1', ['id' => $customer_id]);
            if(count($applications)==0){
                if($source == 'progressive'){
                    return ['success'=>false, 'error'=>true,'additional_info'=>true,'employer_info'=>true,'bank_info'=>true,'msg'=>'Progressive return'];
                }

                $customer_response = $storis->getCustomer($customer_id);
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
                    $result = ['funame' => trim($fullname)?$fullname:"FirstName LastName"
                        , 'first_name'=> trim($customer['firstName'])?$customer['firstName']:"First Name"
                        , 'last_name'=> trim($customer['lastName'])?$customer['lastName']:"Last Name"
                        , 'address'=> trim($address)?$address:"123 Please fill"
                        , 'address2'=>$address2
                        , 'zip'=>$zip?$zip:"12345"
                        , 'city'=>$city?$city:"City Please"
                        , 'state' => $state?$state:"CA"
                        , 'phone' => $phone?$phone:"0000000000"
                        , 'email' => $email?$email:""
                        , 'source' => $source
                        , 'showapplicaiton' => false
                    ];
                    try {
                        $customer_value = ['first_name' => $customer['firstName'],
                            'last_name' => $customer['lastName'],
                            'storis_cust_id' => $customer_id,
                            'email' => $customer['emailAddress']
                        ];
                        foreach ($customer['phones'] as $phonearray) {
                            if ($phonearray['phoneType'] == 'Mobile') {
                                $customer_value['cell_phone'] = $phonearray['number'];
                            } elseif ($phonearray['phoneType'] == 'Home') {
                                $customer_value['home_phone'] = $phonearray['number'];
                            } else {
                                $customer_value['work_phone'] = $phonearray['number'];
                            }
                        }
                        $inserted_record = DB::connection()->table('customer')->insertGetId($customer_value);
                        $address_value = [
                            'customer_id' => $inserted_record,
                            'street' => $address,
                            'apt_number' => $address2,
                            'city' => $city,
                            'state' => $state,
                            'zip' => $zip,
                            'house_type' => 'CURRENT'
                        ];
                        $address_inserted_record = DB::connection()->table('address')->insertGetId($address_value);
                    }catch (Exception $e){
                        return ['success'=>false, 'error'=>true,'msg'=>$e->getMessage()];
                    }
                    $result['db_customer_id'] = $inserted_record;
                    $result['db_address_id'] = $address_inserted_record;

                    return [
                      'success'=>true,
                      'error'=> false,
                      'storis'=>true,
                      'result'=>$result
                    ];
                }else {
                    return ['success'=>false, 'error'=>true,'msg'=>'No record found in Storis or DB'];
                }
            }
        }

        if(count($applications)>0){
            $addresses = $this->getAddresses($applications[0]->id);
            $employers = $this->getEmployers($applications[0]->id);
            if($source == 'progressive'){
                if(count($employers)==0) {
                    return ['success' => false, 'error' => true, 'additional_info' => true, 'employer_info' => true, 'bank_info' => true, 'msg' => 'Progressive return'];
                }else{
                    return ['success' => false, 'error' => true, 'additional_info' => true, 'employer_info' => false, 'bank_info' => true, 'msg' => 'Progressive return'];
                }
            }
            return [
                'success'=>true,
                'error'=>false,
                'application'=>$applications[0],
                'addresses' => $addresses,
                'employers' => $employers,
                'employer_info' => count($employers)?true:false,
                'bread_package' => $this->makeBreadPackage($applications[0],$addresses,$source),
            ];
        }

        return ['success'=>false, 'error'=>true,'msg'=>'No record found in Storis or DB'];

    }

    public function getAddresses($customer_id){
        $addresses = DB::connection()->select('select * from address where customer_id = :id', ['id' => $customer_id]);
        return $addresses;
    }

    public function getEmployers($customer_id){
        $employers = DB::connection()->select('select * from employers where customer_id = :id', ['id' => $customer_id]);
        return $employers;
    }

    protected function makeBreadPackage($application, $addresses,$source){
        $currentAddress = false;
        foreach ($addresses as $address){
            if($address->house_type=='CURRENT'){
                $currentAddress = $address;
            }
        }
        $fullname = $application->first_name." ".$application->last_name;
        $address = $currentAddress?$currentAddress->street:'';
        $address2 = $currentAddress?$currentAddress->apt_number:'';
        $city = $currentAddress?$currentAddress->city:'';
        $state = $currentAddress?$currentAddress->state:'';
        $zip = $currentAddress?$currentAddress->zip:'';
        if($application->cell_phone){
            $phone = $application->cell_phone;
        }elseif ($application->home_phone){
            $phone = $application->home_phone;
        }else{
            $phone = $application->work_phone;
        }
        $email = $application->email;
        return ['funame' => trim($fullname)?$fullname:"FirstName LastName"
            , 'first_name'=> trim($application->first_name)?$application->first_name:""
            , 'last_name'=> trim($application->last_name)?$application->last_name:""
            , 'address'=> trim($address)?$address:"123 Please fill"
            , 'address2'=>$address2
            , 'zip'=>$zip?$zip:"12345"
            , 'city'=>$city?$city:"City Please"
            , 'state' => $state?$state:"CA"
            , 'phone' => $phone?$phone:"0000000000"
            , 'email' => $email?$email:""
            , 'source' => $source
            , 'showapplicaiton' => false
        ];

    }

    protected function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}