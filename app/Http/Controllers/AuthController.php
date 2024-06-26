<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{   
    use AuthenticatesUsers;

    // Define where to redirect users after login
    protected $redirectTo = RouteServiceProvider::HOME;

    // Show the application's login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle a login request to the application.
    public function loginMobile(Request $request){
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Jika email tidak terdaftar, kembalikan dengan pesan kesalahan
            return redirect()->back()->withErrors([
                'email' => 'Email anda tidak terdaftar',
            ]);
        }

        // Jika email terdaftar, coba untuk login
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->intended($this->redirectTo);
        }

        // Jika email terdaftar tetapi password salah, kembalikan dengan pesan kesalahan
        return redirect()->back()->withErrors([
            'password' => 'Password anda salah',
        ]);
    }


    // The user has logged out
    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
