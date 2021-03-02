<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
            if(auth()->user()->username === Hash::check(auth()->user()->password, $req->password)){
                return view('auth.reset_password');
            }else{
                return redirect()->route('poll.index');
            }
        }else{
            return redirect()->back()->with('status', 'Your Password or Username incorrect');
        }
    }

    public function reset()
    {
       return view('auth.reset_password');
    }

    // public function handleresetPassword(Request $request)
    // {
    //     $request->validate([
    //         'old_password' => 'required',
    //         'password' => 'required|confirmed'
    //     ]);

    //     if(Hash::check(auth()->user()->password) !== bcrypt($request->old_password)){
    //         return redirect()->back();
    //         // return false;
    //     }else{
    //       return  User::where(['id' => auth()->user->id])->update(['password' => $request->password]);
    //          Auth::logout();
    //         return redirect()->route('login');
    //     }
    // }

    public function handleLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }



}
