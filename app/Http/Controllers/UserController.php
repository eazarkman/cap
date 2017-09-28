<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
}
