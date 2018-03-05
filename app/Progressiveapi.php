<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;
use App\Misc;

class Progressiveapi extends Model
{
    private $api_url;
    private $username;
    private $password;
    private $store_id;
    public function __construct($mode='live'){
        $this->api_url = Config::get('progressive.'.$mode.'_api_url');
        $this->username = Config::get('progressive.'.$mode.'_username');
        $this->password = Config::get('progressive.'.$mode.'_password');
        $this->store_id = Config::get('progressive.'.$mode.'_store_id');
    }

    public function make_request($requestbody,$actionName){
        $header = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: \"".$actionName."\"",
            "Content-length: ".strlen($requestbody),
        );
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $this->api_url );
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST,           true );
        curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $requestbody);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
        $response = curl_exec($soap_do);

        if($response === false) {
            $err = 'Curl error: ' . curl_error($soap_do);
            curl_close($soap_do);
            return [
                'success'=>false,
                'error' => true,
                'msg' => $err
            ];
        } else {
            curl_close($soap_do);
            $misc = new Misc();
            $result = $misc->xml2array($response);
            if(is_array($result)){
                $response_body = $result['s:Envelope']['s:Body'];
                if(isset($response_body['s:Fault'])){
                    return [
                        'success'=>false,
                        'error' => true,
                        'fault' => $response_body['s:Fault'],
                        'msg' => $response_body['s:Fault']['faultstring']
                    ];
                }else {
                    return [
                        'success' => true,
                        'error' => false,
                        'result' =>$response_body[$actionName.'Response'][$actionName.'Result']
                    ];
                }
            }else{
                return [
                    'success'=>false,
                    'error' => true,
                    'msg' => "Error Parsing XML"
                ];
            }
        }
    }
}