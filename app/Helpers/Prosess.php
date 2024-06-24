<?php

namespace App\Helpers;

use App\Models\LayananAplikasi;
use App\Models\InputLppLayanan;
use App\Models\TimelineLpp;

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

    public function get_dashboard_lpp()
    {
        $Layanan = LayananAplikasi::where(['is_active' => 1])->OrderBy('nama_layanan', 'ASC')->get();

        if (date('m') == '1') {
            $tahun = date('Y', strtotime(date('Y-m-d') . '- 1 month'));
        } else {
            $tahun = date('Y');
        }
        $data = [];
        foreach ($Layanan as $l) {

            $jan = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 1])->with('status')->OrderBy('id', 'DESC')->first();
            $feb = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 2])->with('status')->OrderBy('id', 'DESC')->first();
            $mar = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 3])->with('status')->OrderBy('id', 'DESC')->first();
            $apr = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 4])->with('status')->OrderBy('id', 'DESC')->first();
            $mei = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 5])->with('status')->OrderBy('id', 'DESC')->first();
            $jun = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 6])->with('status')->OrderBy('id', 'DESC')->first();
            $jul = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 7])->with('status')->OrderBy('id', 'DESC')->first();
            $agus = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 8])->with('status')->OrderBy('id', 'DESC')->first();
            $sep = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 9])->with('status')->OrderBy('id', 'DESC')->first();
            $okt = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 10])->with('status')->OrderBy('id', 'DESC')->first();
            $nov = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 11])->with('status')->OrderBy('id', 'DESC')->first();
            $des = InputLppLayanan::where(['is_active' => 1, 'layanan_id' => $l->id, 'tahun' => $tahun, 'bulan' => 12])->with('status')->OrderBy('id', 'DESC')->first();
            $report = [
                'layanan' => $l->nama_layanan,
                'jan' => isset($jan['status']['status_out_tw']) ?  $jan['status']['status_out_tw'] : '',
                'slug_jan' => isset($jan['slug']) ?  $jan['slug'] : '',
                'color_jan' => isset($jan['status']['hex_warna']) ?  $jan['status']['hex_warna'] : '',
                'feb' => isset($feb['status']['status_out_tw']) ?  $feb['status']['status_out_tw'] : '',
                'slug_feb' => isset($feb['slug']) ?  $feb['slug'] : '',
                'color_feb' => isset($feb['status']['hex_warna']) ?  $feb['status']['hex_warna'] : '',
                'mar' => isset($mar['status']['status_out_tw']) ?  $mar['status']['status_out_tw'] : '',
                'slug_mar' => isset($mar['slug']) ?  $mar['slug'] : '',
                'color_mar' => isset($mar['status']['hex_warna']) ?  $mar['status']['hex_warna'] : '',
                'apr' => isset($apr['status']['status_out_tw']) ?  $apr['status']['status_out_tw'] : '',
                'slug_apr' => isset($apr['slug']) ?  $apr['slug'] : '',
                'color_apr' => isset($apr['status']['hex_warna']) ?  $apr['status']['hex_warna'] : '',
                'mei' => isset($mei['status']['status_out_tw']) ?  $mei['status']['status_out_tw'] : '',
                'slug_mei' => isset($mei['slug']) ?  $mei['slug'] : '',
                'color_mei' => isset($mei['status']['hex_warna']) ?  $mei['status']['hex_warna'] : '',
                'jun' => isset($jun['status']['status_out_tw']) ?  $jun['status']['status_out_tw'] : '',
                'slug_jun' => isset($jun['slug']) ?  $jun['slug'] : '',
                'color_jun' => isset($jun['status']['hex_warna']) ?  $jun['status']['hex_warna'] : '',
                'jul' => isset($jul['status']['status_out_tw']) ?  $jul['status']['status_out_tw'] : '',
                'slug_jul' => isset($jul['slug']) ?  $jul['slug'] : '',
                'color_jul' => isset($jul['status']['hex_warna']) ?  $jul['status']['hex_warna'] : '',
                'agus' => isset($agus['status']['status_out_tw']) ?  $agus['status']['status_out_tw'] : '',
                'slug_agus' => isset($agus['slug']) ?  $agus['slug'] : '',
                'color_agus' => isset($agus['status']['hex_warna']) ?  $agus['status']['hex_warna'] : '',
                'sep' => isset($sep['status']['status_out_tw']) ?  $sep['status']['status_out_tw'] : '',
                'slug_sep' => isset($sep['slug']) ?  $sep['slug'] : '',
                'color_sep' => isset($sep['status']['hex_warna']) ?  $sep['status']['hex_warna'] : '',
                'okt' => isset($okt['status']['status_out_tw']) ?  $okt['status']['status_out_tw'] : '',
                'slug_okt' => isset($okt['slug']) ?  $okt['slug'] : '',
                'color_okt' => isset($okt['status']['hex_warna']) ?  $okt['status']['hex_warna'] : '',
                'nov' => isset($nov['status']['status_out_tw']) ?  $nov['status']['status_out_tw'] : '',
                'slug_nov' => isset($nov['slug']) ?  $nov['slug'] : '',
                'color_nov' => isset($nov['status']['hex_warna']) ?  $nov['status']['hex_warna'] : '',
                'des' => isset($des['status']['status_out_tw']) ?  $des['status']['status_out_tw'] : '',
                'slug_des' => isset($des['slug']) ?  $des['slug'] : '',
                'color_des' => isset($des['status']['hex_warna']) ?  $des['status']['hex_warna'] : '',
            ];


            $data[] = $report;
        };

        $data = [
            'data' => $data,
            'tahun' => $tahun
        ];
        return $data;
    }

    public function get_timeline($req)
    {

        $timeline = TimelineLpp::where(['is_active' => 1, 'slug' => $req->slug])->with(['status', 'aplikasi', 'user_created', 'user_updated'])->OrderBy('id', 'DESC')->get();
        $Layanan = InputLppLayanan::where(['is_active' => 1, 'slug' => $req->slug])->with(['status', 'aplikasi', 'user_created', 'user_updated'])->OrderBy('id', 'DESC')->first();

        $data = [
            'timeline' => $timeline,
            'layanan' => $Layanan
        ];
        return $data;
    }
}