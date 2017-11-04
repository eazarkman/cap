<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storis extends Model
{
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
        $customer["applicant"]["homephone"] = $customer['homephone'];
        $customer["applicant"]["cellPhone"] = $customer['varphone'];
        $customer["applicant"]["workPhone"] = $customer['business_phone'];
        $customer["applicant"]["dob"] = '/Date('.strtotime($customer['dob']).')/';

        $url = 'http://ebridge1.storis.com/release/2.0.20.74/STORISapi.svc/rest/1MM6fzjfLgLyM0XKebvFSA-3D-3D/creditapplication';
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
}