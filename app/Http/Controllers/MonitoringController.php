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
        $this->middleware('auth');
    }

    public function monitoring(Request $request){
        $comp = new Component();
        $tahun = $request->input('pilih-tahun', date('Y'));

        $bulanArray = range(1, 12);
        $dataBulan = [];

        foreach ($bulanArray as $bulan) {
            $query = InputLppLayanan::where(['is_active' => 1, 'tahun' => $tahun, 'bulan' => $bulan])
                                    ->with('status', 'aplikasi')
                                    ->orderBy('id', 'DESC');
    
            // Filter berdasarkan kata kunci pencarian jika ada
            if ($request->has('cari') && !empty($request->cari)) {
                $query->whereHas('aplikasi', function ($query) use ($request) {
                    $query->where('nama_layanan', 'like', '%'.$request->cari.'%');
                });
            }
    
            $dataBulan[$bulan] = $query->get();
        }

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

        // Akses data setiap bulan seperti ini:
        // $jan = $dataBulan[1];

        // dd($users);

        return view('monitoring.monitoring', get_defined_vars());
    }

    // END AJAX 
    public function get_timeline(Request $request)
    {
        $prosess = new Prosess();
        $data = $prosess->get_timeline($request);

        return response()->json([
            'pesan' => 'SUCCESS',
            'data' => $data
        ]);
    }

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
