<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function monitoring(){
        $bulanIni = date("m") * 1; //mengambil data bulan berjalan agar dapat dibaca data nama bulan (dalam bentuk angka)
        $tahunIni = date("Y");
        $namaBulanTab = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "Mei",
            "Jun",
            "Jul",
            "Agu",
            "Sep",
            "Okt",
            "Nov",
            "Des"];

        return view('monitoring.monitoring', compact('bulanIni', 'tahunIni', 'namaBulanTab'));
    }

    public function timeline(){
        return view('monitoring.timeline');
    }
}
