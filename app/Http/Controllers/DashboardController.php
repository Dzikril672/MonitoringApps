<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home() {
        $bulanIni = date("m") * 1; //mengambil data bulan berjalan agar dapat dibaca data nama bulan (dalam bentuk angka)
        $tahunIni = date("Y");
        $namaBulan = [
            "",
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"];
        
        return view('dashboard.dashboard', compact('namaBulan', 'bulanIni', 'tahunIni'));
    }
}
