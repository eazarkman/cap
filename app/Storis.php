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
        $customer["applicant"]["currentAddress"]["zipCode"] = $customer['zip'];
        $customer["applicant"]["fullName"] = $customer['first_name'].' '.$customer['last_name'];
        $customer["applicant"]["firstName"] = $customer['first_name'];
        $customer["applicant"]["lastName"] = $customer['last_name'];
        $customer["applicant"]["emailAddress"] = $customer['email'];
        $customer["applicant"]["homephone"] = $customer['home_phone'];
        $customer["applicant"]["cellPhone"] = $customer['cell_phone'];
        $customer["applicant"]["workPhone"] = $customer['work_phone'];
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

    public function getOrder($order_id,$customer_id){
        $url = $this->storis_url.'/'.$this->storis_token.'/orders/'.$order_id.',2?customerId='.$customer_id;
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
            if(isset($result['salesOrder'])){
                //return $result['customer'];
                return [
                    'success' => true,
                    'error'  => false,
                    'msg' => 'Successfully got the record',
                    'order' => $result['salesOrder']
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