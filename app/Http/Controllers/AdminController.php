<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
    public function login(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL)? 'email' : 'username';

        
        if($fieldType == 'email'){
            $request->validate([
                'login_id' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:45'
            ],[
                'login_id.required' => 'Eamil is required',
                'login_id.email' => 'Email is invalid',
                'login_id.exists' => 'Email does not exist',
                'password.required' => 'Password is required'
            ]);
        }else{
            $request->validate([
                'login_id' => 'required|exists:admins,username',
                'password' => 'required|min:5|max:45'
            ], 
            [
                'login_id.required' => 'Email or username is required',
                'login_id.exists' => 'Username is not exist',
                'password.required' => 'Password is required'
            ]);
        }

        $cerds = array(
            $fieldType => $request->login_id,
            'password' => $request->password 
        );

        
        
        if(Auth::guard('admin')->attempt($cerds)){
            return redirect()->route('admin.home');
        }else{
            session()->flash('fail', 'Incorrect Credentials');
            return redirect()->route('admin.login');
        }

        }

        public function logout(){
            Auth::guard('admin')->logout();
            session()->flash('fail', 'You are logged out!');
            return redirect()->route('admin.login');
        }

}
