<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
    public function getCustomerData($app_id = null,$customer_id = '' , $source, $storis){
        if(!$app_id && !$customer_id){
            return ['success'=>false, 'error'=>true,'msg'=>'Please provide either customer id or app id'];
        }
        if($app_id){
            $applications = DB::connection('defi')->select('select * from customer where app_id = :id order by id DESC limit 1', ['id' => $app_id]);
        }elseif ($customer_id){
            $applications = DB::connection('defi')->select('select * from customer where storis_cust_id = :id  order by id DESC limit 1', ['id' => $customer_id]);
            if(count($applications)==0){
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
            return [
                'success'=>true,
                'error'=>false,
                'application'=>$applications[0],
                'addresses' => $addresses,
                'employers' => $this->getEmployers($applications[0]->id),
                'bread_package' => $this->makeBreadPackage($applications[0],$addresses,$source),
            ];
        }

        return ['success'=>false, 'error'=>true,'msg'=>'No record found in Storis or DB'];

    }

    public function getAddresses($customer_id){
        $addresses = DB::connection('defi')->select('select * from address where customer_id = :id', ['id' => $customer_id]);
        return $addresses;
    }

    public function getEmployers($customer_id){
        $employers = DB::connection('defi')->select('select * from employers where customer_id = :id', ['id' => $customer_id]);
        return $employers;
    }

    protected function makeBreadPackage($application, $addresses,$source){
        $currentAddress = '';
        foreach ($addresses as $address){
            if($address->house_type=='CURRENT'){
                $currentAddress = $address;
            }
        }
        $fullname = $application->first_name." ".$application->last_name;
        $address = $currentAddress->street;
        $address2 = $currentAddress->apt_number;
        $city = $currentAddress->city;
        $state = $currentAddress->state;
        $zip = $currentAddress->zip;
        if($application->cell_phone){
            $phone = $application->cell_phone;
        }elseif ($application->home_phone){
            $phone = $application->home_phone;
        }else{
            $phone = $application->work_phone;
        }
        $email = $application->email;
        return ['funame' => trim($fullname)?$fullname:"FirstName LastName"
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