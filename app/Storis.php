<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

class Storis extends Model
{
    private $storis_url;
    private $storis_token;
    public function __construct(){
        $this->storis_url = Config::get('storis.api_url');
        $this->storis_token = Config::get('storis.api_token');
    }
    public function getUrl(){
        return $this->storis_url;
    }
     /**
     * @param array $customer
     */
    public function createCustomer($customer)
    {

        $customer["applicant"]["currentAddress"]["address1"]=$customer['street_number']." ".$customer['street_name']." ".$customer['street_type'];
        $customer["applicant"]["currentAddress"]["address2"] = $customer['apt_number'];
        $customer["applicant"]["currentAddress"]["city"] = $customer['city'];
        $customer["applicant"]["currentAddress"]["state"] = $customer['state'];
        $customer["applicant"]["currentAddress"]["zipCode"] = $customer['zipcode'];
        $customer["applicant"]["fullName"] = $customer['firstname'].' '.$customer['lastname'];
        $customer["applicant"]["firstName"] = $customer['firstname'];
        $customer["applicant"]["lastName"] = $customer['lastname'];
        $customer["applicant"]["emailAddress"] = $customer['email'];
        $customer["applicant"]["homephone"] = $customer['homephone'];
        $customer["applicant"]["cellPhone"] = $customer['varphone'];
        $customer["applicant"]["workPhone"] = $customer['business_phone'];
        $customer["applicant"]["dob"] = '/Date('.(strtotime($customer['dob'].'+1 day')*1000).'-0400)/';

        $url = $this->storis_url.'/'.$this->storis_token.'/creditapplication';
        $headers[] = 'content-type: application/json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($customer));
        $response = curl_exec($ch);
        if (!$response)
        {
            return false;
        }

        $result = json_decode($response,true);
        if(is_array($result)){
            if(isset($result['customerId'])) {
                return ['success' => true, 'error' => false, 'customer_id' => $result['customerId']];
            }elseif(isset($result['message'])){
                return ['success' => false, 'error' => true, 'message' => $result['message']];
            }

        }
        return false;
    }

    public function getCustomer($customer_id){
        $session_id = str_random(10);

        $url = $this->storis_url.'/'.$this->storis_token.'/customers/'.$customer_id.','.$session_id;
        $headers[] = 'content-type: application/json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $response = curl_exec($ch);

        if (!$response)
        {
            return false;
        }

        $result = json_decode($response,true);

        if(is_array($result)){
            if(isset($result['customer'])){
                //return $result['customer'];
                return [
                    'success' => true,
                    'error'  => false,
                    'msg' => 'Successfully got the record',
                    'customer' => $result['customer']
                ];
            }elseif (isset($result['message'])){
                return [
                    'success' => false,
                    'error'  => true,
                    'message' => $result['message']
                ];
            }
        }
    }
}