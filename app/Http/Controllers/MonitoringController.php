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
        $tahunIni = date('Y');

        $bulanArray = range(1, 12);
        $dataBulan = [];

        $bulanIni = date("m") * 1;
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
            "Des"
        ];

        foreach ($bulanArray as $bulan) {
            $query = InputLppLayanan::where(['is_active' => 1, 'tahun' => $tahunIni, 'bulan' => $bulan])
                                    ->with('status', 'aplikasi')
                                    ->orderBy('id', 'DESC');
    
            $dataBulan[$bulan] = $query->get();
        }

        return view('monitoring.monitoring', get_defined_vars());
    }


    public function get_timeline(Request $request)
    {
        $prosess = new Prosess();
        $data = $prosess->get_timeline($request);

        return response()->json([
            'pesan' => 'SUCCESS',
            'data' => $data
        ]);
    }
    
    public function getDataByYear(Request $request)
    {
        $Pilihtahun = $request->input('tahun');
        $cari = $request->input('cari');
        // \Log::info('Tahun yang diterima: ' . $Pilihtahun);
        $bulanArray = range(1, 12);
        $dataBulan = [];

        foreach ($bulanArray as $bulan) {
            // Create a query to fetch data based on the year, month, and is_active status
            $query = InputLppLayanan::where([
                                            'is_active' => 1, 
                                            'tahun' => $Pilihtahun, 
                                            'bulan' => $bulan
                                        ])
                                        ->with('status', 'aplikasi')
                                        ->orderBy('id', 'DESC');
        
            // Filter based on search keyword if any
            if ($request->has('cari') && !empty($cari)) {
                $query->whereHas('aplikasi', function ($query) use ($cari) {
                    $query->where('nama_layanan', 'like', '%'.$cari.'%');
                });
            }
        
            // Get the data for the current month and store it in the $dataBulan array
            $dataBulan[$bulan] = $query->get();
        }
            // dd($dataBulan);
        return response()->json($dataBulan);
    }
}
