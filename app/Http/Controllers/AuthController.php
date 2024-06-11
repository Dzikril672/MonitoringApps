<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginMobile(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('/dashboard'); 
        } else {
            return redirect('/')  -> with(['warning' => 'Email atau Password yang anda masukan salah']);
        }
    }

    public function logoutMobile(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/');
        }
    }
}
