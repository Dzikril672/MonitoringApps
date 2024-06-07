<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function monitoring(){
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
