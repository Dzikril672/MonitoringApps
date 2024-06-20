<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use app\Helpers\Prosess;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function monitoring(){
        $users = User::all();

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

        return view('monitoring.monitoring', compact('bulanIni', 'tahunIni', 'namaBulanTab'));
    }

    public function timeline(){
        return view('monitoring.timeline');
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

    // public function index() {
    //     try {
    //         // Koneksi ke database
    //         $dbconnect = DB::connection()->getPDO();
    //         $dbname = DB::connection()->getDatabaseName();
    //         echo "Connected successfully to the database. Database name is : " . $dbname . "<br>";
    
    //         // Query untuk mengambil nama tabel
    //         $tables = DB::select('SHOW TABLES');
    //         $tableKey = 'Tables_in_' . $dbname;
    
    //         foreach ($tables as $table) {
    //             $tableName = $table->$tableKey;
    //             echo "Table: " . $tableName . "<br>";
    
    //             // Query untuk mengambil struktur tabel, gunakan backticks (`) untuk menghindari kesalahan sintaks pada nama tabel dengan karakter khusus
    //             $columns = DB::select('DESCRIBE `' . $tableName . '`');
    
    //             echo "<table border='1'>";
    //             echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    //             foreach ($columns as $column) {
    //                 echo "<tr>";
    //                 echo "<td>" . $column->Field . "</td>";
    //                 echo "<td>" . $column->Type . "</td>";
    //                 echo "<td>" . $column->Null . "</td>";
    //                 echo "<td>" . $column->Key . "</td>";
    //                 echo "<td>" . $column->Default . "</td>";
    //                 echo "<td>" . $column->Extra . "</td>";
    //                 echo "</tr>";
    //             }
    //             echo "</table><br>";
    //         }
    //     } catch (Exception $e) {
    //         echo "Error in connecting to the database: " . $e->getMessage();
    //     }
    // }    
    
}
