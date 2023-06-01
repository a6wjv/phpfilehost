<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\AdminRole;
use App\Models\Admin;
use App\Models\User;

class LoginController extends Controller
{
    public function adminLogin(Request $request)
    {
       if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
              $request->session()->regenerateToken();
              session()->put('user_role_id',Auth::guard('admin')->user()->admin_role_id);
              $userRole=AdminRole::where('id',Auth::guard('admin')->user()->admin_role_id)->first('name');
              session()->put('role_name', $userRole->name);
        return redirect()->route('dashboard');
       }else{
            return back()->withErrors(['failed'=> "Invalid Credentials"]);
       }
    }
    function forgetpassword_admin(Request $req){
      $admin_data = Admin::where('email',$req->forgot_password_email)->first();
      if(!empty($admin_data))
      {
          $email = $req->forgot_password_email;
          $username = $admin_data->name;
          Mail::send('forgotpassword.forget_password_request_email', [
              'email' => $email,
              'username' => $username
               ],
              function($message) use ($email,$username){
                      $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
                      $message->to($email)->subject('Reset Password Notification');
                  });
          echo "<script>alert('please check your email');</script>";
          echo "<script>history.back();</script>";
      }
      else{
          echo "<script>alert('please provide admin Email Id');</script>";
          echo "<script>history.back();</script>";
      }
     }
     
     function forgetpassword_reset_admin(Request $req){
      $admin_mail = $req->email;
      return view('forgotpassword.resetpw',compact('admin_mail'));
     }

     function forgetpassword_reset_update_admin(Request $req)
     {
      $admin_data = Admin::where('email', $req->email)->first();
          if(!empty($admin_data))
          {
              $admin_data->password =bcrypt($req->reset_password_new);
              $admin_data->save();
              echo "<script>alert('Password updated successfully');</script>";
              echo "<script>window.location.href = '".url('/')."/';</script>";
          }
          else{
              echo "<script>alert('Password not updated');</script>";
              echo "<script>window.location.href = '".url('/')."/';</script>";
          }
     }
    public function logout(Request $request)
    {
      if (isset(Auth::guard('admin')->user()->name)) {
         Auth::guard('admin')->logout();
      }
      $request->session()->invalidate();
      return redirect('/');
    }
}
