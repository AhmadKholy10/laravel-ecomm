<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use constDefaults;
use constGuards;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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

        public function sendPasswordReset(Request $request){
            $request->validate([
                'email' => 'required|email|exists:admins,email'
            ],[
                'email.required' => 'The :attribute is required',
                'email.email' => 'Invalid email address',
                'email.exists' => 'The :attribute does not exist '
            ]);
            //Get admin details
            $admin = Admin::where('email', $request->email)->first();

            //Generate token
            $token = base64_encode(Str::random(64));

            //Check if there is an existing reset password token 
            $oldToken = DB::table('password_reset_tokens')
                        ->where(['email'=> $request->email, 'guard'=> constGuards::ADMIN])
                        ->first();
            
            if($oldToken){
                //Update token
                DB::table('password_reset_tokens')
                        ->where(['email'=> $request->email, 'guard'=> constGuards::ADMIN])
                        ->update([
                            'token'=> $token,
                            'created_at' => Carbon::now()
                        ]);
            }else{
                //Add the token
                DB::table('password_reset_tokens')->insert([
                    'email'=> $request->email,
                    'guard'=> constGuards::ADMIN,
                    'token'=> $token,
                    'created_at'=> Carbon::now()
                ]);
            }

            $actionLink = route('admin.reset-password',['token'=> $token, 'email'=>$request->email]);
            $data = array(
                'actionLink'=> $actionLink,
                'admin'=> $admin
            );

            $mail_body = view('email-templates.admin-forgot-email-template', $data)->render();

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' => $admin->email,
                'mail_recipient_name' => $admin->name,
                'mail_subject' => 'Reset Password',
                'mail_body' => $mail_body
            );

            if(sendEmail($mailConfig)){
                session()->flash('success', 'we have e-mailed your password reset link');
                return redirect()->route('admin.forgot-password');
            }else{
                session()->flash('fail', 'Something went wrong!');
                return redirect()->route('admin.forgot-password');
            }

        }

        public function resetPassword(Request $request, $token){
            $check_token = DB::table('password_reset_tokens')
                           ->where(['token'=> $token, 'guard'=> constGuards::ADMIN])
                           ->first();
            if(!$check_token){
                session()->flash('fail', 'Invalid token, Request another reset password link');
                return redirect()->route('admin.forgot-password', ['token'=> $token]);
            }

            $minutes_difference = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)
                                  ->diffInMinutes(Carbon::now());
            
            if($minutes_difference > 15){
                session()->flash('fail', 'Token expired, Request another reset password link');
                return redirect()->route('admin.forgot-password',['token'=>$token]);
            }

            return view('back.pages.admin.auth.reset-password')->with(['token'=>$token]);
        }

        public function doResetPassword(Request $request){
            $request->validate([
                'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|
                same:new_password_confirmation',
                'new_password_confirmation' => 'required'
            ]);

            $token = DB::table('password_reset_tokens')
                        ->where(['token'=> $request->token, 'guard'=> constGuards::ADMIN])
                        ->first();
            
            //Get admin details
            $admin = Admin::where('email', $token->email)->first();

            //Update the admin password
            Admin::where('email', $admin->email)->update([
                'password' => Hash::make($request->new_password)
            ]);

            //Delete the token
            DB::table('password_reset_tokens')
                ->where([
                    'email' => $admin->email,
                    'token' => $request->token,
                    'guard' => constGuards::ADMIN
                ])->delete();

            $data = array(
                    'admin'=> $admin,
                    'new_password' => $request->new_password
                );
            
            $mail_body = view('email-templates.admin-reset-email-template', $data)->render();

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' => $admin->email,
                'mail_recipient_name' => $admin->name,
                'mail_subject' => 'Password Changed',
                'mail_body' => $mail_body
            );

            sendEmail($mailConfig);
            return redirect()->route('admin.login')
                   ->with('success', 'Done!, Your password has been reset.  Use your new password to login');

        }

}
