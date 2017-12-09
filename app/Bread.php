<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

class Bread extends Model
{
    private $api_url;
    private $api_token;
    private $mode;
    public function __construct($mode='live'){
        $this->api_url = Config::get('bread.'.$mode.'_api_url');
        $this->api_token = base64_encode(Config::get('bread.'.$mode.'_api_key').":".Config::get('bread.'.$mode.'_api_Secret'));
        $this->mode = $mode;
    }
    public function getUrl(){
        return $this->api_url;
    }
    public function getToken(){
        return $this->api_token;
    }

    public function authorizeTransaction($transaction_id,$order_id){
        $merchantJSON = json_encode(['merchantOrderId'=>$order_id,'type'=>'authorize']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getUrl()."/transactions/actions/".$transaction_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "$merchantJSON",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic ".$this->getToken(),
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return [
                'success' => false,
                'error'  => true,
                'message' => "cURL Error #:" . $err." for further information please contact Starworld"
            ];
        } else {
            if($this->isJson($response)){
                $result = json_decode($response, 1);
                if(isset($result['error'])){
                    return [
                        'success' => false,
                        'error'  => true,
                        'message' => $result['description']." for further information please contact Starworld"
                    ];
                }else{
                    return [
                        'success' => true,
                        'error'  => false,
                        'message' => 'Successfully authorized the transaction'
                    ];
                }
            }else{
                return [
                    'success' => false,
                    'error'  => true,
                    'message' => 'An unexpected error occur'
                ];
            }

        }
    }

    protected function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}