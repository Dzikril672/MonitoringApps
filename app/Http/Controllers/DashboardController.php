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

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function home(Request $request) {
    
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
            "Desember"
        ];
    
        $lppDdanger = InputLppLayanan::whereNotIn('status_id', [11])
            ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
            ->orderBy('id', 'DESC')->get();

        // dd($lppDdanger);
    
        $jumlahLppBelum = InputLppLayanan::whereNotIn('status_id', [11])
            ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
            ->orderBy('id', 'DESC')->count();
    
        $lppInfo = InputLppLayanan::where([
            'thbl' => date('Ym', strtotime(date('Y-m-d') . '- 1 month')),
        ])->whereIn('status_id', [11])
            ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
            ->orderBy('id', 'DESC')->get();
    
        $jumlahLppBerjalan = InputLppLayanan::where([
            'thbl' => date('Ym', strtotime(date('Y-m-d') . '- 1 month')),
        ])->whereIn('status_id', [11])
            ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
            ->orderBy('id', 'DESC')->count();
    
        $totalLayanan = LayananAplikasi::where(['is_active' => 1])->count();
    
        $lppSelesai = InputLppLayanan::where(['thbl' => date('Ym', strtotime(date('Y-m-d') . '- 1 month'))])
            ->whereIn('status_id', [11])->count();
    
        $lppBelumSelesai = $totalLayanan - $lppSelesai;
    
        return view('dashboard.dashboard', get_defined_vars());
    }

    public function searchBelumSelesai(Request $request) {
        $cariBelum = $request->cariBelum;
    
        $cariLayananBelum = InputLppLayanan::whereNotIn('status_id', [11])
            ->whereHas('aplikasi', function($query) use ($cariBelum) {
                if (!empty($cariBelum)) {
                    $query->where('nama_layanan', 'like', '%' . $cariBelum . '%');
                }
            })
            ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
            ->orderBy('id', 'DESC')
            ->get();
    
        return response()->json($cariLayananBelum);
    }
    public function searchBerjalan(Request $request) {
        $cariBerjalan = $request->cariBerjalan;
    
        $cariLayananBerjalan = InputLppLayanan::where([
            'thbl' => date('Ym', strtotime(date('Y-m-d') . '- 1 month')),
            ])->whereIn('status_id', [11])
            ->whereHas('aplikasi', function($query) use ($cariBerjalan) {
                if (!empty($cariBerjalan)) {
                    $query->where('nama_layanan', 'like', '%' . $cariBerjalan . '%');
                }
            })
            ->with(['aplikasi', 'status', 'user_created', 'user_updated'])
            ->orderBy('id', 'DESC')
            ->get();
    
        return response()->json($cariLayananBerjalan);
    }
    
    
}
