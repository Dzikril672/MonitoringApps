<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function profil(){
        return view('profil.profile');
    }
    public function updateprofil(){
        return view("profil.editprofile");
    }
    public function changepass(){
        return view("profil.changepassword");
    }
}
