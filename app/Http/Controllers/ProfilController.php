<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfilController extends Controller
{
    public function profil(){
        $user = Auth::user();
        return view('profil.profile', compact('user'));
    }
    
    public function updateprofil(){
        $user = Auth::user();
        return view("profil.editprofile", compact("user"));
    }
    public function changepass(){
        return view("profil.changepassword");
    }
}
