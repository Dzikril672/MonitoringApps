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
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $comp = new Component();
        $prosess = new Prosess();
        $data = $prosess->get_lpp_bulanan($request);
        // $menu = $comp->get_menu();
        // $passing = [
        //     'title' => 'Dashboard',
        //     'menu' => $menu,
        // ];

        dd($data);

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
        $ratarataDiBawah = DB::table('RATA-RATA-DIBAWAH')->select(['AVG_SLA_TERCAPAI'])->first();
        $ratarataDiAtas = DB::table('RATA-RATA-DIATAS')->select(['AVG_SLA_TDKCAPAI'])->first();
        $ratarataDiBawah = number_format($ratarataDiBawah->AVG_SLA_TERCAPAI, 2);
        $ratarataDiAtas = number_format($ratarataDiAtas->AVG_SLA_TDKCAPAI, 2);
        return view('monitoring.test', get_defined_vars());
    }

    // AJAX 

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

        return response()->json([
            'pesan' => 'SUCCESS',
            'data' => $data
        ]);
    }

    // public function get_desc_sla(Request $request)
    // {
    //     $prosess = new Prosess();
    //     $data = $prosess->get_desc_sla($request);

    //     return response()->json([
    //         'pesan' => 'SUCCESS',
    //         'data' => $data
    //     ]);
    // }

    // END AJAX 
}
