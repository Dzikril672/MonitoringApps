<?php

namespace App\Helpers;

use App\Models\LayananAplikasi;
use App\Models\InputLppLayanan;
use App\Models\TimelineLpp;
use App\Models\TimelineParaf;
use Illuminate\Http\Request;

class Prosess{

    public function get_timeline($req)
    {
        $timeline = TimelineLpp::where(['is_active' => 1, 'slug' => $req->slug])->with(['status', 'aplikasi', 'user_created', 'user_updated','paraf'])->OrderBy('id', 'DESC')->get();
        $Layanan = InputLppLayanan::where(['is_active' => 1, 'slug' => $req->slug])->with(['status', 'aplikasi', 'user_created', 'user_updated'])->OrderBy('id', 'DESC')->first();
       
        $data = [
            'timeline' => $timeline,
            'layanan' => $Layanan
        ];
        return $data;
    }

}