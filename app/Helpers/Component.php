<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Helpers\Exception;

// MODELS
use App\Models\User;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\MappingMenu;
use App\Models\Role;
use App\Models\Status;
use App\Models\InputLppLayanan;

class Component
{
    // function get_menu()
    // {
    //     $role_user = Auth::user()->role_id;
    //     $menu = MappingMenu::where(['parent_id' => 0, 'is_active' => 1, 'id_role' => Auth::user()->role])->with(str_repeat('children.', 2))->get();
    //     return $menu;
    // }
    // function get_menu_by_role($id)
    // {
    //     $role_user = Auth::user()->role_id;
    //     $menu = MappingMenu::where(['parent_id' => 0, 'is_active' => 1, 'id_role' => $id])->with(str_repeat('children.', 2))->get();
    //     return $menu;
    // }

    function logs($logs)
    {
        Log::info(
            "CONTROLER => " . $logs['controler'] . " | USERS => " . Auth::user()->name . " | PESAN => " . $logs['pesan'] . " | PARAMS => " . $logs['data']
        );
    }
    function logsError($logs)
    {
        Log::info(
            "CONTROLER => " . $logs['controler'] . " | USERS => " . Auth::user()->name . " | PESAN => " . $logs['pesan'] . " | PARAMS => " . $logs['data']
        );
    }

    // DATE FORMATER
    public function __construct()
    {
        if (!isset($GLOBALS["date_day_id"])) $GLOBALS["date_day_id"] = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        if (!isset($GLOBALS["date_month_id"])) $GLOBALS["date_month_id"] = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        if (!isset($GLOBALS["date_month_en"])) $GLOBALS["date_month_en"] = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        if (!isset($GLOBALS["date_simple_month_id"])) $GLOBALS["date_simple_month_id"] = array("JAN", "FEB", "MAR", "APR", "MEI", "JUNI", "JULI", "AUG", "SEPT", "OKT", "NOV", "DES");
        if (!isset($GLOBALS["date_simple_month"])) $GLOBALS["date_simple_month"] = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
    }

    function date_reformat($format = "", $strdate = "")
    {
        return @date($format, @strtotime($strdate));
    }


    function hari_tanggal($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return $date_day_id[date("w", $sttime)] . ", " . date("j", $sttime) . " " . $date_month_id[date("n", $sttime) - 1] . " " . date("Y", $sttime);
        } else {
            return date("l, F j Y");
        }
    }

    function tanggal($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return date("j", $sttime) . " " . $date_month_id[date("n", $sttime) - 1] . " " . date("Y", $sttime);
        } else {
            return date("l, F j Y");
        }
    }

    function hari_tanggal_jam($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return date("j", $sttime) . " " . $date_month_id[date("n", $sttime) - 1] . " " . date("Y", $sttime) . ' - ' . date("H:i:s", $sttime);
        } else {
            return date("l, F j Y");
        }
    }

    function jam_menit($strdate, $lang = "id")
    {
        global $date_day_id, $date_month_id;

        $sttime = @strtotime($strdate);
        if ($lang == "id") {
            return date("H:i", $sttime);
        } else {
            return date("l, F j Y");
        }
    }

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        );
        return $bulan[$tanggal];
    }
    function next_status($status)
    {
        if ($status ==  11) {
            return "selesai";
        } else {
            $next = Status::where(['kode_status' => $status])->first();
            $next = Status::where(['urutan' => $next['urutan'] + 1])->first();
            return $next['status_tw'];
        }
    }
    // END DATE FORMATER


    function get_role($idrole)
    {

        $role = Role::where(['id_role' =>  $idrole])->first();

        return $role['nama_role'];
    }

    function hitung_persen($slug, $layanan)
    {



        $cek = InputLppLayanan::where(['slug' => $slug, 'is_active' => 1, 'layanan_id' => $layanan, 'status_id' => 11])->first();
        // dd($cek);

        if (isset($cek['updated_at'])) {
            $tanggal = explode(" ", $this->tanggal($cek['updated_at']));
            $tanggal = $tanggal[0];
            $tanggal = (int) str_replace('0', '', $tanggal);
            $persen = (10 / $tanggal) * 100;
            $flag = true;
        } else {
            $tanggal = 0;
            $persen = 0;
            $flag = false;
        }


        return $data = [
            'flag' => $flag,
            'persen' => number_format($persen, 2)
        ];
    }

    // function dateConver($data)
    // {
    //     $dConvert = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($data);
    //     return date('Y-m-d H:i:s', $dConvert);
    // }
}
