<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function profileForm()
    {
        $userid = Auth::guard('admin')->user()->id;
        $url = route('updateProfile', ['id' => $userid]);
        $userdata = Admin::where('id', $userid)->first();
        return view('profile.profileform',compact('userdata','url'));
    }
    public function updateProfile(Request $request)
    {
        $userdata = Admin::where('id', $request->id)->first();
        if(isset($request->userpassword)){
        $userdata->password=bcrypt($request->userpassword);
        }
        $userdata->email=$request->userid ?? '';
        $userdata->name=$request->name ?? '';
        if (isset($request->profilePicture)) {
            $file = time() . '.' . $request->profilePicture->getClientOriginalExtension();
            $path = public_path('assets/ProfilePictures');
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
            $request->profilePicture->move($path, $file);
        }
        $userdata->image=$file ?? $request->userImage;
        $userdata->save();
        Session::flash('message','Profile Updated Successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back();
    }
}
