<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        if(auth()->user()){
            return view('auth.reset_password');
        }
        return view('auth.login');
    }
    public function handleLogin(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);                                                                              

        if(Auth::attempt(['username' => $req->username, 'password' => $req->password])){
            // check jika menggunakan password default maka arahkan ke reset password
            if(auth()->user()->password === auth()->user()->password){
                return view('auth.reset_password');
            }else{
                return redirect()->route('poll.index');
            }
        }else{
            return redirect()->back()->with('danger', 'Your Password or Username incorrect');
        }
    }

    public function reset()
    {
       return view('auth.reset_password');
    }

    public function handleresetPassword(Request $request)
    {
       $isvalid =  Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if($isvalid->fails()){
            return redirect()->back()->with('status', 'Check your input data');
        }
        $old = $request->old_password;
        $new = $request->password;

        if(!Hash::check($old, auth()->user()->password)){
            return redirect()->back()->with('status', 'Old Password not match');
        }else{
            $user = User::findOrfail(auth()->user()->id);
            $user->password = bcrypt($new);
            $user->save();
            Auth::logout();
            return redirect('/')->with('status', 'Password reset succesfully');
        }
        // check user password
        // check user input new password
        // check confirm input new password
        // change user password
        // redirect to login page & logout user login
    }

    public function handleLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }



}
