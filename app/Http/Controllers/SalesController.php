<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
    public function checkapp(Request $request)
    {
        //TODO :: Grab value from DB and populate here
       // TODO :: Conditional check
        $result = ['funame' => 'Any Thing'
                    , 'address'=> '123 Main St'
                    , 'address2'=>''
                    , 'zip'=>'90015'
                    , 'city'=>'Los Angeles'
                    , 'state' => 'CA'
                    , 'phone' => '2589631254'
                    , 'email' => 'any@thing.com'
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
