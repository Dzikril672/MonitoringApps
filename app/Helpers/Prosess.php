<?php

namespace App\Helpers;

use App\Models\LayananAplikasi;
use App\Models\InputLppLayanan;
use App\Models\TimelineLpp;
use App\Models\TimelineParaf;
use Illuminate\Http\Request;

class Prosess{
    public function get_lpp_bulanan($req)
    {
        $Layanan = LayananAplikasi::where(['is_active' => 1])->OrderBy('nama_layanan', 'ASC')->get();

        
        $data = [];
        foreach ($Layanan as $l) {
            $Until = new Component();
            $lastupdate = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 11])->first();

            if (isset($lastupdate)) {
                $nextBulan = date('Y-m', strtotime('+1 month', strtotime($lastupdate['tahun'] . '-' . $lastupdate['bulan'])));
                $nextBulan2 = date('Y-m-d', strtotime('+1 month', strtotime($nextBulan . "-1")));
                if (date('Y-m-d', strtotime($lastupdate['updated_at'])) > $nextBulan . "-10") {
                    $warna = 'text-danger';
                } elseif (date('Y-m-d', strtotime($lastupdate['updated_at'])) >= $nextBulan . "-08") {
                    $warna = "text-warning";
                } else {
                    $warna = "text-success";
                }
            } else {
                $warna = '';
            }

            // dd($nextBulan2);
            $step2 = TimelineLpp::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 1])->OrderBy('id', 'DESC')->limit(1)->get();
            $step3 = TimelineLpp::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 2])->OrderBy('id', 'DESC')->limit(1)->get();
            $step4 = TimelineLpp::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 4])->OrderBy('id', 'DESC')->limit(1)->get();
            $step5 = TimelineLpp::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 5])->OrderBy('id', 'DESC')->limit(1)->get();
            $step6 = TimelineLpp::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 7])->OrderBy('id', 'DESC')->limit(1)->get();
            $step7 = TimelineLpp::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 9])->OrderBy('id', 'DESC')->limit(1)->get();
            $step8 = TimelineLpp::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $req->tahun, 'bulan' => $req->bulan, 'status_id' => 11])->OrderBy('id', 'DESC')->limit(1)->get();
            $step = [
                'step2' => isset($step2[0]['status_id']) ? 'cheked' : 0,
                'step3' => isset($step3[0]['status_id']) ? 'cheked' : 0,
                'step4' => isset($step4[0]['status_id']) ? 'cheked' : 0,
                'step5' => isset($step5[0]['status_id']) ? 'cheked' : 0,
                'step6' => isset($step6[0]['status_id']) ? 'cheked' : 0,
                'step7' => isset($step7[0]['status_id']) ? 'cheked' : 0,
                'step8' => isset($step8[0]['status_id']) ? 'Complate' : 'Not Complate',
                'tanggal2' => isset($step2[0]['created_at']) ? $Until->tanggal($step2[0]['created_at']) : '',
                'tanggal3' => isset($step3[0]['created_at']) ? $Until->tanggal($step3[0]['created_at']) : '',
                'tanggal4' => isset($step4[0]['created_at']) ? $Until->tanggal($step4[0]['created_at']) : '',
                'tanggal5' => isset($step5[0]['created_at']) ? $Until->tanggal($step5[0]['created_at']) : '',
                'tanggal6' => isset($step6[0]['created_at']) ? $Until->tanggal($step6[0]['created_at']) : '',
                'tanggal7' => isset($step7[0]['created_at']) ? $Until->tanggal($step7[0]['created_at']) : '',
                'tanggal8' => isset($step8[0]['created_at']) ? $Until->tanggal($step8[0]['created_at']) : '',
            ];
            $report = [
                'name' => $l->nama_layanan,
                'bulan' => $req->bulan,
                'tahun' => $req->tahun,
                'data' => $step,
                'warna' => $warna
            ];


            $data[] = $report;
        };

        return $data;
    }

    public function get_timeline($req)
    {

        $timeline = TimelineLpp::where(['is_active' => 1, 'slug' => $req->slug])->with(['status', 'aplikasi', 'user_created', 'user_updated','paraf'])->OrderBy('id', 'DESC')->get();
        $Layanan = InputLppLayanan::where(['is_active' => 1, 'slug' => $req->slug])->with(['status', 'aplikasi', 'user_created', 'user_updated'])->OrderBy('id', 'DESC')->first();
       
        $data = [
            'timeline' => $timeline,
            'layanan' => $Layanan
        ];
        return $data;
    }

}