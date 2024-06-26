<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MappingMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Helpers\Component;
use App\Helpers\Prosess;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\LayananAplikasi;
use App\Models\LayananBidang;
use App\Models\DbUsulanSop;
use App\Models\InputLppLayanan;
use App\Models\InputSlaLayanan;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $comp = new Component();
        $tahun = $request->input('tahun', date('Y'));

        $bulanArray = range(1, 12);
        $dataBulan = [];

        $request->merge(['slug' => '2023-04@apkt']);

        $prosess = new Prosess();
        $data = $prosess->get_timeline($request);

        dd($data);

        // foreach ($bulanArray as $bulan) {
        //     $dataBulan[$bulan] = InputLppLayanan::where(['is_active' => 1, 'tahun' => $tahun, 'bulan' => $bulan])
        //         ->with('status', 'aplikasi')
        //         ->OrderBy('id', 'DESC')
        //         ->get();
        // }

        $prosess = new Prosess();
        // $data = $prosess->get_lpp_bulanan($request);
        $data = $prosess->get_timeline($request);


        dd($data);

        // Akses data setiap bulan seperti ini:
        // $jun = $dataBulan[6];

        // dd($jun);
        // $bulan2 = date('n');
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
        

        return view('monitoring.test', get_defined_vars());
    }

    public function getDashboardLpp(Request $request)
    {
        $tahun = $request->input('tahun');
        $dataBulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $dataBulan[$i] = InputLppLayanan::where(['is_active' => 1, 'tahun' => $tahun, 'bulan' => $i])
                ->with('status', 'aplikasi')
                ->orderBy('id', 'DESC')
                ->get();
        }

        return response()->json(['dataBulan' => $dataBulan]);
    }

    // AJAX 

    // public function get_dashboard_lpp(Request $request)
    // {
    //     $prosess = new Prosess();
    //     $data = $prosess->get_dashboard_lpp();

    //     return response()->json([
    //         'pesan' => 'SUCCESS',
    //         'data' => $data
    //     ]);
    // }
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

    public function get_lpp_bulanan(Request $request)
    {
        $prosess = new Prosess();
        $data = $prosess->get_lpp_bulanan($request);

        dd($data);

        return response()->json([
            'pesan' => 'SUCCESS',
            'data' => $data
        ]);
    }
}
