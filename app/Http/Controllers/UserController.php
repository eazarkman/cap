<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use League\Flysystem\Exception;

class UserController extends Controller
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
        return view('users',compact('users'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'admin' => $data['admin'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request) {
        $input = $request->all();
        //print_r($input);
        //exit;
        $validator = $this->validator($input);
        if ($validator->passes()) {
            $this->create($input);
            return redirect()->to('users');
        }
        return back()->with('errors',$validator->errors());
    }

    public function fetchuser(Request $request){
        $user = User::findOrFail($request->get('id'));
        return response()->json($user);
    }
    public function updateuser(Request $request){
        try {
            $user = User::findOrFail($request->get('id'));
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->admin = $request->get('admin');
            $user->save();
            return response()->json(['success'=>true,'error'=>false,'msg'=>'Record updated successfully !!']);
        }catch (Exception $e){
            return response()->json(['success'=>false,'error'=>true,'msg'=>$e->getMessage()]);
        }
    }
    public function deleteuser(Request $request){
        try {
            $user = User::findOrFail($request->get('id'));
            $user->forceDelete();
            return response()->json(['success'=>true,'error'=>false,'msg'=>'Record deleted successfully !!']);
        }catch (Exception $e){
            return response()->json(['success'=>false,'error'=>true,'msg'=>$e->getMessage()]);
        }
    }
}
