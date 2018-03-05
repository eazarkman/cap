<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;
use App\Storis;
use App\Progressiveapi;
class Progressive extends Model
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

    protected function getAuth(){
        return '<app:Authentication>
                    <app:Username>'.$this->username.'</app:Username>
                    <app:Password>'.$this->password.'</app:Password>
                </app:Authentication>';
    }
    protected function getStoreInfo(){
            return '<app:Store>
                        <app:StoreId>'.$this->store_id.'</app:StoreId>
                        <app:StoreName />
                        <app:StoreApplicationIdentifier />
                    </app:Store>';
    }
    public function SubmitPartialApplication($data){
        $requestbody  = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:app="http://progfinance.com/Application">
                        <soapenv:Header />
                        <soapenv:Body>
                            <app:SubmitPartialCreditCardApplication>
                                <!--Optional:-->
                                <app:submission xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                                    '.$this->getAuth().$this->getStoreInfo().'
                                    <app:Applicant>
                                        <app:FirstName>'.$data['FirstName'].'</app:FirstName>
                                        <app:LastName>'.$data['LastName'].'</app:LastName>
                                        <app:SocialSecurityNumber>'.$data['SocialSecurityNumber'].'</app:SocialSecurityNumber>
                                        <app:BirthDate>'.$data['BirthDate'].'T00:00:00</app:BirthDate>
                                        <app:HomePhone>'.$data['HomePhone'].'</app:HomePhone>
                                        <app:CellPhone />
                                        <app:IsMilitary>false</app:IsMilitary>
                                        <app:IsSocialSecurityBenefits>false</app:IsSocialSecurityBenefits>
                                        <app:IsSelfEmployed>false</app:IsSelfEmployed>
                                        <app:EMailAddress />
                                        <app:HomeOwnership>Rent</app:HomeOwnership>
                                        <app:CustomerAddresses>
                                            <app:CustomerAddress>
                                                <app:StreetAddress1>'.$data['StreetAddress1'].'</app:StreetAddress1>
                                                <!--Optional:-->
                                                <app:StreetAddress2>'.$data['StreetAddress2'].'</app:StreetAddress2>
                                                <app:City>'.$data['City'].'</app:City>
                                                <app:State>'.$data['State'].'</app:State>
                                                <app:Zip>'.$data['Zip'].'</app:Zip>
                                                <app:MonthsAtAddress>12</app:MonthsAtAddress>
                                            </app:CustomerAddress>
                                        </app:CustomerAddresses>
                                        <app:Bank>
                                            <app:BankName>'.$data['BankName'].'</app:BankName>
                                             <app:ABARoutingNumber>'.$data['ABARoutingNumber'].'</app:ABARoutingNumber>
                                             <app:AccountNumber>'.$data['AccountNumber'].'</app:AccountNumber>
                                             <app:AccountType>'.$data['AccountType'].'</app:AccountType>
                                             <app:DateAccountOpened>'.$data['DateAccountOpened'].'T00:00:00</app:DateAccountOpened>
                                             <app:NumberOfNSFFees>0</app:NumberOfNSFFees>
                                             <app:NumberOfOverdraftFees>0</app:NumberOfOverdraftFees>
                                        </app:Bank>
                                        <app:Employment>
                                            <app:EmployerName/>
                                            <app:Occupation xsi:nil="true" />
                                            <app:HireDate>'.$data['HireDate'].'T00:00:00</app:HireDate>
                                            <app:MonthlyGrossIncome>'.$data['MonthlyGrossIncome'].'</app:MonthlyGrossIncome>
                                            <app:LastPayDate>'.$data['LastPayDate'].'T00:00:00</app:LastPayDate>
                                            <app:PayFrequency>'.$data['PayFrequency'].'</app:PayFrequency>
                                            <app:SupervisorName />
                                            <app:WorkPhone />
                                            <app:WorkPhoneExtension />
                                        </app:Employment>
                                    </app:Applicant>
                                    <app:CreditCardBIN>'.$data['CreditCardBin'].'</app:CreditCardBIN>
                                </app:submission>
                            </app:SubmitPartialCreditCardApplication>
                        </soapenv:Body>
                    </soapenv:Envelope>
                    ';

        $api = new Progressiveapi();
        return $api->make_request($requestbody,'SubmitPartialCreditCardApplication');
    }

    public function createInvoice($order_id,$customer_id,$account_number){
        $storis = new Storis();
        $order_response = $storis->getOrder($order_id,$customer_id);
        if(is_array($order_response)) {
            if(isset($order_response['success'])&&$order_response['success']) {
                $order = $order_response['order'];
                $items = $this->getMerchndise($order['lineItems']);
                if ($order['orderTotals']['install']>0){
                    $items .= '<app:MerchandiseItem>
                                 <!--Optional:-->
                                 <app:SKU>installation</app:SKU>
                                 <!--Optional:-->
                                 <app:Model>installation</app:Model>
                                 <app:Description>Installation Charge</app:Description>
                                 <app:PriceEach>'.$order['orderTotals']['install'].'</app:PriceEach>
                                 <app:Quantity>1</app:Quantity>
                              </app:MerchandiseItem>';
                }


                $requestbody  = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:app="http://progfinance.com/Application">
                       <soapenv:Header />
                       <soapenv:Body>
                          <app:SubmitInvoiceInformation>
                             <app:submission xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                                '.$this->getAuth().'
                                <app:ApplicationId>
                                   <app:StoreApplicationIdentifier xsi:nil="true" />
                                   <app:AccountNumber>'.$account_number.'</app:AccountNumber>
                                </app:ApplicationId>
                                <app:Invoice xsi:nil="true" />
                                <app:StandardInvoice>
                                   <app:InvoiceNumber>'.$order['orderId'].'</app:InvoiceNumber>
                                   <app:InvoiceTotal>'.$order['orderTotals']['invoiceTotal'].'</app:InvoiceTotal>
                                   <app:AdditionalAmountDown>0</app:AdditionalAmountDown>
                                   <app:DeliveryCharge>'.$order['orderTotals']['delivery'].'</app:DeliveryCharge>
                                   <app:SalesTax>'.$order['orderTotals']['tax'].'</app:SalesTax>
                                   <app:InvoiceDate>'.date('Y-m-d').'T00:00:00</app:InvoiceDate>
                                   <app:Merchandise>
                                      <!--Zero or more repetitions:-->
                                      '.$items.'
                                   </app:Merchandise>
                                </app:StandardInvoice>
                                <!--Optional:-->
                                <app:DeliverContract>false</app:DeliverContract>
                             </app:submission>
                          </app:SubmitInvoiceInformation>
                       </soapenv:Body>
                    </soapenv:Envelope>
                    ';


                $api = new Progressiveapi();
                return $api->make_request($requestbody,'SubmitInvoiceInformation');
            }else{
                if(isset($order_response['message'])) {
                    return response()->json(['success' => false, 'error' => true, 'msg' => $order_response['message']]);
                }
            }
        }


    }
    protected function getMerchndise($line_items){
        $items = '';
        foreach ($line_items as $item){
            $items .= '<app:MerchandiseItem>
                         <!--Optional:-->
                         <app:SKU>'.$item['id'].'</app:SKU>
                         <!--Optional:-->
                         <app:Model>'.$item['vendorModelNumber'].'</app:Model>
                         <app:Description>'.$item['description'].'</app:Description>
                         <app:PriceEach>'.round($item['price']/$item['quantity'],2).'</app:PriceEach>
                         <app:Quantity>'.$item['quantity'].'</app:Quantity>
                      </app:MerchandiseItem>';
        }
        return $items;

    }
    public function validateABA($abanumber){
        $soap_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:app="http://progfinance.com/Application">
                       <soapenv:Header/>
                       <soapenv:Body>
                          <app:ValidateABANumber>
                             <app:request>
                                '.$this->getAuth().'
                                <app:ABAInfo>
                                   <app:ABANumber>'.$abanumber.'</app:ABANumber>
                                </app:ABAInfo>
                             </app:request>
                          </app:ValidateABANumber>
                       </soapenv:Body>
                    </soapenv:Envelope>
                    ';

        $api = new Progressiveapi();
        return $api->make_request($soap_request,'ValidateABANumber');
    }

}