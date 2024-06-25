<?php

namespace App\Http\Controllers;

use App\Helpers\Component;
use App\Models\User as ModelsUser;
use app\Helpers\Prosess;
use App\Models\InputLppLayanan;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function monitoring(){
        $users = User::all();
        $comp = new Component();
        $tahun = 2024;

        $bulanArray = range(1, 12);
        $dataBulan = [];

        foreach ($bulanArray as $bulan) {
            $dataBulan[$bulan] = InputLppLayanan::where(['is_active' => 1, 'tahun' => $tahun, 'bulan' => $bulan])
                ->with('status', 'aplikasi')
                ->OrderBy('id', 'DESC')
                ->get();
        }

        // Akses data setiap bulan seperti ini:
        // $jan = $dataBulan[1];

        // dd($users);

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

        return view('monitoring.monitoring', get_defined_vars());
    }

    public function get_dashboard_lpp(Request $request)
    {
        $prosess = new Prosess();
        $data = $prosess->get_dashboard_lpp();

        return response()->json([
            'pesan' => 'SUCCESS',
            'data' => $data
        ]);
    }

    // END AJAX 
    // public function get_timeline(Request $request)
    // {
    //     $prosess = new Prosess();
    //     $data = $prosess->get_timeline($request);

    //     return response()->json([
    //         'pesan' => 'SUCCESS',
    //         'data' => $data
    //     ]);
    // }

    // public function get_lpp_bulanan(Request $request)
    // {
    //     $prosess = new Prosess();
    //     $data = $prosess->get_lpp_bulanan($request);

    //     return response()->json([
    //         'pesan' => 'SUCCESS',
    //         'data' => $data
    //     ]);
    // }   
    
}
