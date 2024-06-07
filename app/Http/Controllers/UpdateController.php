<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function updateprofil(){
        return view("profil.editprofile");
    }
}
