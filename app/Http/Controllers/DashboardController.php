<?php

namespace App\Http\Controllers;

use App\Helpers\Component;
use App\Models\InputLppLayanan;
use App\Models\LayananAplikasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home() {
        $comp = new Component();
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

        $lppDdanger = InputLppLayanan::whereNotIn('status_id', [11])
        ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
        ->OrderBy('id', 'DESC')->get();

        $lppInfo = InputLppLayanan::where([
            'thbl' => date('Ym', strtotime(date('Y-m-d') . '- 1 month')),
        ])->whereIn('status_id', [11])
            ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
            ->OrderBy('id', 'DESC')->get();

        $totalLayanan = LayananAplikasi::where(['is_active' => 1])->count();

        $lppSelesai = InputLppLayanan::where(['thbl' => date('Ym', strtotime(date('Y-m-d') . '- 1 month'))])
            ->whereIn('status_id', [11])->count();

        $lppBelumSelesai = $totalLayanan - $lppSelesai;

        // dd($lppBelumSelesai);
        
        return view('dashboard.dashboard', get_defined_vars());
    }
}
