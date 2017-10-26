<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
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
        $applications = DB::connection('defi')->select('select * from Customers where appid = :id', ['id' => $request->get('appnumber')]);

        $fullname = $address = $city = $state = $zip = $phone = $email = '';
        foreach ($applications as $application)
        {
           $fullname = $application->firstname." ".$application->lastname;
           $address = $application->street;
           $city = $application->city;
           $state = $application->state;
           $zip = $application->zipcode;
           if($application->homephone){
               $phone = $application->homephone;
           }elseif ($application->workphone){
               $phone = $application->workphone;
           }else{
               $phone = $application->varphone;
           }
           $email = $application->email;
        }

        $result = ['funame' => $fullname?$fullname:""
                    , 'address'=> $address?$address:""
                    , 'address2'=>''
                    , 'zip'=>$zip?$zip:""
                    , 'city'=>$city?$city:""
                    , 'state' => $state?$state:""
                    , 'phone' => $phone?$phone:""
                    , 'email' => $email?$email:""
                    , 'source' => $request->get('source')
                ];

        //$result = ['status'=>'not found'];
        return response()->json($result);
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
}
