<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MappingMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            $tahun =  date('Y');
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
                $query = InputLppLayanan::where(['is_active' => 1, 'tahun' => $tahun, 'bulan' => $bulan])
                                        ->with('status', 'aplikasi')
                                        ->orderBy('id', 'DESC');

                if ($request->has('cari') && !empty($request->cari)) {
                    $query->whereHas('aplikasi', function ($query) use ($request) {
                        $query->where('nama_layanan', 'like', '%' . $request->cari . '%');
                    });
                }

                $dataBulan[$bulan] = $query->get();
            }

            if ($request->ajax()) {
                // Debugging dengan dd() sebelum mengirim respons
                dd($dataBulan);
                return response()->json($dataBulan); // Mengirimkan data dalam format JSON
            }

            // dd($dataBulan);

            return view('monitoring.test', get_defined_vars());
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


    // AJAX 
    public function get_timeline(Request $request)
    {
        $prosess = new Prosess();
        $data = $prosess->get_timeline($request);

        return response()->json([
            'pesan' => 'SUCCESS',
            'data' => $data
        ]);
    }
}
