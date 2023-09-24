<?php

namespace App\Http\Controllers;

use App\Models\DataAnakModel;
use App\Models\DataIbuModel;
use App\Models\VitaminAModel;
use App\Models\TimbanganModel;
use App\Models\VaksinModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Highcharts;

use Illuminate\Support\Facades\DB;

class TimbanganController extends Controller
{
    public function index()
    {
        $data['Anak'] = DataAnakModel::where(['is_deleted' => 0])->get();

        $nm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $data['list'] = TimbanganModel::whereMonth('tanggal_pencatatan', '=', $nm)
                        ->whereYear('tanggal_pencatatan', '=', $nY)
                        ->where(['is_deleted' => 0])->with('Dataanak')->get();
        $data['list2'] = TimbanganModel::where(['is_deleted' => 0])->with('Dataanak')->get();
        return view('admin.timbangan.index', $data);
    }

    public function createtimbangan()
    {
        $data['jenkel']= null;
        $grafik = array(60);
        for ($i=0; $i < 60; $i++) { 
            $grafik[$i] = null;
        }
        $data['Anak'] = DataAnakModel::where(['is_deleted' => 0])->with('Dataibu')->get();
        $data['list'] = TimbanganModel::where(['is_deleted' => 0])->with('Dataanak')->get();
        return view('admin.timbangan.create', $data)->with('grafik',json_encode($grafik,JSON_NUMERIC_CHECK));
    }

    public function insert(Request $request)
    {
        $nm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $check = TimbanganModel::where(['id_anak' => $request->dataanak])->whereMonth('tanggal_pencatatan', '=', $nm)->where(['is_deleted' => 0])->first();

        if (!$check) {
            $insert['tanggal_pencatatan'] = date('Y-m-d');
            $insert['tinggi_badan'] = $request->tinggi_badan;
            $insert['berat_badan'] = $request->berat_badan;
            $insert['id_anak'] = $request->dataanak;

            $anak = DataAnakModel::where(['id_anak' => $request->dataanak])->first();
            $now = Carbon::now()->format('Y-m-d'); // Tanggal sekarang
            $b_day = Carbon::parse($anak->tgl_lhr); // Tanggal Lahir
            $age = $b_day->diffInMonths($now);  // Menghitung umur

            $insert['umur'] = $age;

            $jk = $anak->jenkel;
            $bb = $request->berat_badan;
            $umur = $age;

            if ($jk == "P") {
                if ($umur <= 1) {
                    if ($bb < 2.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 2.8 && $bb < 3.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 3.1 && $bb < 5.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 2) {
                    if ($bb < 3.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 3.4 && $bb < 3.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 3.9 && $bb < 6.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 3) {
                    if ($bb < 4.0) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.0 && $bb < 4.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 4.5 && $bb < 7.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 4) {
                    if ($bb < 4.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.4 && $bb < 5.0) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.0 && $bb < 8.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 5) {
                    if ($bb < 4.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.8 && $bb < 5.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.4 && $bb < 8.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 6) {
                    if ($bb < 5.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.1 && $bb < 5.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.7 && $bb < 9.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 7) {
                    if ($bb < 5.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.3 && $bb < 6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6 && $bb < 9.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 8) {
                    if ($bb < 5.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.6 && $bb < 6.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.2 && $bb < 10.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 9) {
                    if ($bb < 5.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.8 && $bb < 6.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.5 && $bb < 10.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 10) {
                    if ($bb < 6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6 && $bb < 6.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.7 && $bb < 10.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 11) {
                    if ($bb < 6.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.1 && $bb < 6.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.9 && $bb < 11.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 12) {
                    if ($bb < 6.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.3 && $bb < 7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7 && $bb < 11.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 13) {
                    if ($bb < 6.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.4 && $bb < 7.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.2 && $bb < 11.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 14) {
                    if ($bb < 6.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.6 && $bb < 7.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.4 && $bb < 12.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 15) {
                    if ($bb < 6.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.8 && $bb < 7.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.6 && $bb < 12.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 16) {
                    if ($bb < 6.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.9 && $bb < 7.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.7 && $bb < 12.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 17) {
                    if ($bb < 7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7 && $bb < 7.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.9 && $bb < 12.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 18) {
                    if ($bb < 7.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.2 && $bb < 8.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.1 && $bb < 13.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 19) {
                    if ($bb < 7.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.3 && $bb < 8.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.2 && $bb < 13.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 20) {
                    if ($bb < 7.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.5 && $bb < 8.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.4 && $bb < 13.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 21) {
                    if ($bb < 7.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.6 && $bb < 8.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.6 && $bb < 14) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 22) {
                    if ($bb < 7.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.8 && $bb < 8.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.7 && $bb < 14.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 23) {
                    if ($bb < 7.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.9 && $bb < 8.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.9 && $bb < 14.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 24) {
                    if ($bb < 8.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.1 && $bb < 9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9 && $bb < 14.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 25) {
                    if ($bb < 8.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.2 && $bb < 9.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.2 && $bb < 15.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 26) {
                    if ($bb < 8.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.3 && $bb < 9.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.3 && $bb < 15.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 27) {
                    if ($bb < 8.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.5 && $bb < 9.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.5 && $bb < 15.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 28) {
                    if ($bb < 8.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.6 && $bb < 9.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.7 && $bb < 16) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 29) {
                    if ($bb < 8.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.8 && $bb < 9.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.8 && $bb < 16.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 30) {
                    if ($bb < 8.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.9 && $bb < 10) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10 && $bb < 16.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 31) {
                    if ($bb < 9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9 && $bb < 10.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.1 && $bb < 16.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 32) {
                    if ($bb < 9.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.1 && $bb < 10.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.3 && $bb < 17) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 33) {
                    if ($bb < 9.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.2 && $bb < 10.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.4 && $bb < 17.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 34) {
                    if ($bb < 9.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.4 && $bb < 10.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.5 && $bb < 17.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 35) {
                    if ($bb < 9.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.5 && $bb < 10.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.7 && $bb < 17.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 36) {
                    if ($bb < 9.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.6 && $bb < 10.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.8 && $bb < 18.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 37) {
                    if ($bb < 9.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.7 && $bb < 10.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.9 && $bb < 18.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 38) {
                    if ($bb < 9.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.8 && $bb < 11.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.1 && $bb < 18.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 39) {
                    if ($bb < 10) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10 && $bb < 11.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.2 && $bb < 19) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 40) {
                    if ($bb < 10.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.1 && $bb < 11.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.3 && $bb < 19.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 41) {
                    if ($bb < 10.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.2 && $bb < 11.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.4 && $bb < 19.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 42) {
                    if ($bb < 10.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.3 && $bb < 11.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.6 && $bb < 19.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 43) {
                    if ($bb < 10.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.4 && $bb < 11.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.7 && $bb < 20.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 44) {
                    if ($bb < 10.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.5 && $bb < 11.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.8 && $bb < 20.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 45) {
                    if ($bb < 10.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.6 && $bb < 12) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12 && $bb < 20.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 46) {
                    if ($bb < 10.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.7 && $bb < 12.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.1 && $bb < 20.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 47) {
                    if ($bb < 10.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.8 && $bb < 12.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.4 && $bb < 21.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 48) {
                    if ($bb < 10.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.9 && $bb < 12.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.3 && $bb < 21.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 49) {
                    if ($bb < 11) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11 && $bb < 12.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.4 && $bb < 21.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 50) {
                    if ($bb < 11.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.1 && $bb < 12.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.6 && $bb < 22.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 51) {
                    if ($bb < 11.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.2 && $bb < 12.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.7 && $bb < 22.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 52) {
                    if ($bb < 11.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.3 && $bb < 12.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.8 && $bb < 22.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 53) {
                    if ($bb < 11.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.4 && $bb < 12.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.9 && $bb < 22.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 54) {
                    if ($bb < 11.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.5 && $bb < 13) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13 && $bb < 23.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 55) {
                    if ($bb < 11.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.6 && $bb < 13.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.2 && $bb < 23.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 56) {
                    if ($bb < 11.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.7 && $bb < 13.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.3 && $bb < 23.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 57) {
                    if ($bb < 11.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.8 && $bb < 13.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.4 && $bb < 24.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 58) {
                    if ($bb < 11.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.9 && $bb < 13.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.5 && $bb < 24.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 59) {
                    if ($bb < 12) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12 && $bb < 13.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.6 && $bb < 24.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 60) {
                    if ($bb < 12.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.1 && $bb < 13.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.7 && $bb < 24.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } else {
                    "Bayi Lulus";
                }
            } else {
                if ($umur <= 1) {
                    if ($bb < 2.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 2.9 && $bb < 3.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 3.4 && $bb < 5.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 2) {
                    if ($bb < 3.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 3.8 && $bb < 4.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 4.3 && $bb < 7.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 3) {
                    if ($bb < 4.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.4 && $bb < 5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5 && $bb < 8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 4) {
                    if ($bb < 4.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 4.9 && $bb < 5.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 5.5 && $bb < 8.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 5) {
                    if ($bb < 5.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.3 && $bb < 6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6 && $bb < 9.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 6) {
                    if ($bb < 5.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.7 && $bb < 6.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.3 && $bb < 9.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 7) {
                    if ($bb < 5.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 5.9 && $bb < 6.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.7 && $bb < 10.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 8) {
                    if ($bb < 6.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.2 && $bb < 6.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 6.9 && $bb < 10.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 9) {
                    if ($bb < 6.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.4 && $bb < 7.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.1 && $bb < 11) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 10) {
                    if ($bb < 6.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.6 && $bb < 7.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.3 && $bb < 11.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 11) {
                    if ($bb < 6.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.8 && $bb < 7.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.6 && $bb < 11.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 12) {
                    if ($bb < 6.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 6.9 && $bb < 7.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.7 && $bb < 12) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 13) {
                    if ($bb < 7.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.1 && $bb < 7.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 7.9 && $bb < 12.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 14) {
                    if ($bb < 7.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.3 && $bb < 8.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.1 && $bb < 12.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 15) {
                    if ($bb < 7.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.4 && $bb < 8.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.3 && $bb < 12.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 16) {
                    if ($bb < 7.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.6 && $bb < 8.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.4 && $bb < 13.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 17) {
                    if ($bb < 7.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.7 && $bb < 8.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.6 && $bb < 13.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 18) {
                    if ($bb < 7.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 7.8 && $bb < 8.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.8 && $bb < 13.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 19) {
                    if ($bb < 8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8 && $bb < 8.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 8.9 && $bb < 13.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 20) {
                    if ($bb < 8.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.1 && $bb < 9.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.1 && $bb < 14.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 21) {
                    if ($bb < 8.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.2 && $bb < 9.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.2 && $bb < 14.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 22) {
                    if ($bb < 8.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.4 && $bb < 9.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.4 && $bb < 14.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 23) {
                    if ($bb < 8.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.5 && $bb < 9.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.5 && $bb < 15) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 24) {
                    if ($bb < 8.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.6 && $bb < 9.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.7 && $bb < 15.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 25) {
                    if ($bb < 8.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.8 && $bb < 9.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 9.8 && $bb < 15.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 26) {
                    if ($bb < 8.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 8.9 && $bb < 10) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10 && $bb < 15.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 27) {
                    if ($bb < 9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9 && $bb < 10.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.1 && $bb < 16.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 28) {
                    if ($bb < 9.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.1 && $bb < 10.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.2 && $bb < 16.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 29) {
                    if ($bb < 9.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.2 && $bb < 10.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.4 && $bb < 16.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 30) {
                    if ($bb < 9.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.4 && $bb < 10.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.5 && $bb < 16.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 31) {
                    if ($bb < 9.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.5 && $bb < 10.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.6 && $bb < 17.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 32) {
                    if ($bb < 9.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.6 && $bb < 10.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.8 && $bb < 17.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 33) {
                    if ($bb < 9.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.7 && $bb < 10.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 10.9 && $bb < 17.6) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 34) {
                    if ($bb < 9.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.8 && $bb < 11) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11 && $bb < 17.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 35) {
                    if ($bb < 9.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 9.9 && $bb < 11.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.2 && $bb < 18.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 36) {
                    if ($bb < 10) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10 && $bb < 11.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.3 && $bb < 18.3) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 37) {
                    if ($bb < 10.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.1 && $bb < 11.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.4 && $bb < 18.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 38) {
                    if ($bb < 10.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.2 && $bb < 11.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.5 && $bb < 18.8) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 39) {
                    if ($bb < 10.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.3 && $bb < 11.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.7 && $bb < 19) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 40) {
                    if ($bb < 10.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.4 && $bb < 11.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.8 && $bb < 19.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 41) {
                    if ($bb < 10.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.5 && $bb < 11.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 11.9 && $bb < 19.5) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 42) {
                    if ($bb < 10.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.6 && $bb < 12) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12 && $bb < 19.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 43) {
                    if ($bb < 10.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.7 && $bb < 12.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.1 && $bb < 20) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 44) {
                    if ($bb < 10.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.8 && $bb < 12.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.2 && $bb < 20.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 45) {
                    if ($bb < 10.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 10.9 && $bb < 12.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.4 && $bb < 20.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 46) {
                    if ($bb < 11) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11 && $bb < 12.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.5 && $bb < 20.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 47) {
                    if ($bb < 11.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.1 && $bb < 12.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.6 && $bb < 21) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 48) {
                    if ($bb < 11.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.2 && $bb < 12.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.7 && $bb < 21.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 49) {
                    if ($bb < 11.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.3 && $bb < 12.8) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.8 && $bb < 21.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 50) {
                    if ($bb < 11.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.4 && $bb < 12.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 12.9 && $bb < 21.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 51) {
                    if ($bb < 11.5) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.5 && $bb < 13) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13 && $bb < 21.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 52) {
                    if ($bb < 11.6) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.6 && $bb < 13.2) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.2 && $bb < 22.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 53) {
                    if ($bb < 11.7) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.7 && $bb < 13.3) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.3 && $bb < 22.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 54) {
                    if ($bb < 11.8) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.8 && $bb < 13.4) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.4 && $bb < 22.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 55) {
                    if ($bb < 11.9) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 11.9 && $bb < 13.5) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.5 && $bb < 22.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 56) {
                    if ($bb < 12) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12 && $bb < 13.6) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.6 && $bb < 23.2) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 57) {
                    if ($bb < 12.1) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.1 && $bb < 13.7) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.7 && $bb < 23.4) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 58) {
                    if ($bb < 12.2) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.2 && $bb < 13.9) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 13.9 && $bb < 23.7) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 59) {
                    if ($bb < 12.3) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.3 && $bb < 14) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 14 && $bb < 23.9) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } elseif ($umur == 60) {
                    if ($bb < 12.4) {
                        $q = "BB Sangat Kurang";
                    } elseif ($bb >= 12.4 && $bb < 14.1) {
                        $q = "BB Kurang";
                    } elseif ($bb >= 14.1 && $bb < 24.1) {
                        $q = "BB Normal";
                    } else {
                        $q = "BB Lebih";
                    }
                } else {
                    "Bayi Lulus";
                }
            }

            $insert['status_gizi'] = $q;
            if ($q == 'BB Sangat Kurang') {
                $cek_kasus = TimbanganModel::where('id_anak', $request->dataanak)->OrderBy('id', 'desc')->first();
                if($cek_kasus)
                {
                    if ($cek_kasus->status_gizi == 'BB Sangat Kurang') {
                        $insert['kasus'] = 0;
                    } else {
                        $insert['kasus'] = 1;
                    }
                }
                
            }
            ////////Status Gizi End
            ////////Ket Timbang Cek
            $ct_count = TimbanganModel::where('id_anak', $request->dataanak)->count();
            if ($ct_count > 2) {
                $ct = TimbanganModel::where('id_anak', $request->dataanak)->OrderBy('tanggal_pencatatan', 'desc')->first();
                $ct1 = TimbanganModel::where('id_anak', $request->dataanak)->OrderBy('tanggal_pencatatan', 'desc')->offset(1)->limit(1)->first();
                $bb_kemarin = $ct->berat_badan;
                $bb_kemarin_lusa = $ct1->berat_badan;
                // dd($bb_kemarin_lusa , $bb_kemarin);
                if ($bb_kemarin < $bb_kemarin_lusa && $bb < $bb_kemarin && $q == 'BB Sangat Kurang') {
                    $ket_t = "Balita 2T & BGM";
                } elseif ($bb_kemarin < $bb_kemarin_lusa && $bb < $bb_kemarin) {
                    $ket_t = "Balita 2T";
                } elseif ($q == 'BB Sangat Kurang') {
                    $ket_t = "Balita BGM";
                } elseif ($q == 'BB Lebih') {
                    $ket_t = "Balita Gemuk";
                } else {
                    $ket_t = "Balita Normal";
                }
            } else {
                if ($q == 'BB Sangat Kurang') {
                    $ket_t = "Balita BGM";
                } elseif ($q == 'BB Lebih') {
                    $ket_t = "Balita Gemuk";
                } else {
                    $ket_t = "Balita Normal";
                }
            }
            // dd($t_bln_now, $temp_t_bln, $aaa);
            $insert['ket_timbangan'] = $ket_t;
            ////////Ket Timbang End

            //////// INDIKASI Naik Cek
            $ct_countt = TimbanganModel::where('id_anak', $request->dataanak)->count();
            // dd($ct_countt);
            if ($ct_countt >= 1) {
                $ct = TimbanganModel::where('id_anak', $request->dataanak)->OrderBy('tanggal_pencatatan', 'desc')->first();
                $bb_kemarin = $ct->berat_badan;
                if ($bb < $bb_kemarin) {
                    $ind_naik = "tdk naik";
                } else {
                    $ind_naik = "naik";
                }
            } else {
                $ind_naik = "belum";
            }
            // dd($t_bln_now, $temp_t_bln, $aaa);
            $insert['indikasi_naik'] = $ind_naik;
            ////////Ket Timbang End

             //////// INDIKASI tidak timbang bulan lalu Cek
             $bln_lalu = Carbon::now()->addMonth(-1)->format('m'); // Tanggal sekarang bulan
             if ($ct_countt >= 1) {
                 $t_lalu = TimbanganModel::where('id_anak', $request->dataanak)->whereMonth('tanggal_pencatatan', $bln_lalu)->first();
                
                 if ($t_lalu == null) {
                     $ind_t_lalu = 0; // tidak timbang
                 } else {
                     $ind_t_lalu = 1; // timbang
                 }
             } else {
                 $ind_t_lalu = 1; 
             }
             
             
             $insert['indikasi_tidak_timbang_bulan_lalu'] = $ind_t_lalu;
             ////////Ket Timbang End

            //////// INDIKASI baru timbang bulan lalu Cek
            $b_lalu_c = TimbanganModel::where('id_anak', $request->dataanak)->with('Dataanak')->count();
            if ($b_lalu_c == 1) {
                $b_lalu = TimbanganModel::where('id_anak', $request->dataanak)->first();
                // $bln = Carbon::parse('2018-08-12')->format('m');
                if (Carbon::parse($b_lalu->tanggal_pencatatan)->format('m') == $bln_lalu) {
                    $ind_b_lalu = 0; //baru timbang
                } else {
                    $ind_b_lalu = 1;
                }
            } else {
                $ind_b_lalu = 1;
            }
            // dd($b_lalu);
            $insert['indikasi_baru_timbang_bulan_lalu'] = $ind_b_lalu;
            ////////Ket Timbang End
            
            ////////Vit A Cek
            $vitamin = 'n';
            date_default_timezone_set('Asia/Jakarta');
            // $bln = Carbon::parse('2018-08-12')->format('m');
            $bln = Carbon::now()->format('m');
            if ($bln == '02' or $bln == '08') {
                if ($umur >= 6 && $umur <= 11) { ///Vit A Biru
                    $vitamin = 'y';
                    $q1 = "Anak : ".$anak->nama_anak.", Umur : ".$umur." Bulan || Waktunya Pemberian Vitamin A Biru";
                    ///input data vit A
                    $vitA = new VitaminAModel;
                    $vitA->id_anak = $request->dataanak;
                    $vitA->tgl_vitA = $now;
                    $vitA->keterangan = "Vitamin A Biru";
                    $vitA->save();
                } elseif ($umur >= 12 && $umur <= 60) { ///Vit A Merah
                    $vitamin = 'y';
                    $q1 = "Anak : ".$anak->nama_anak.", Umur : ".$umur." Bulan || Waktunya Pemberian Vitamin A Merah";
                    ///input data vit A
                    $vitA = new VitaminAModel;
                    $vitA->id_anak = $request->dataanak;
                    $vitA->tgl_vitA = $now;
                    $vitA->keterangan = "Vitamin A Merah";
                    $vitA->save();
                } else {
                    "Bayi Lulus";
                }
            }
            ////////Vit A End

            /////////Imunisasi Cek
            $var_array=[];
            $imunisasi = 'n';
            $imuns = VaksinModel::all();
            foreach ($imuns as $imun) {
                if ($imun->umur == $umur) {
                    array_push($var_array, $imun->nama_imun);
                    $imunisasi = 'y';
                }
            }
            // dd($var_array);
            /////////Imunisasi End

            $data = TimbanganModel::create($insert);
            /////////Get Data Timbang Anak
            // $dataKelamin = Anak::where('id_anak', $id)->first();
            $dK = DataAnakModel::where('id_anak', $request->dataanak)->first();
            $dataKelamin = $dK->jenkel;

            // dd($dataKelamin);

            $t = DB::table('tb_anak as A')
                    ->leftjoin('tb_timbangan as T', 'A.id_anak', '=', 'T.id_anak')
                    ->select('A.id_anak', 'A.nama_anak', 'T.umur', 'T.berat_badan', 'T.tinggi_badan', 'T.tanggal_pencatatan')
                    ->where('A.id_anak', $request->dataanak)
                    ->get();
            $grafik = array(61);
            for ($i=0; $i < 61; $i++) { 
                $grafik[$i] = null;
            }
            $grafik[0] = $dK->bb_lahir;
            foreach ($t as $some) {
                $grafik[$some->umur] = $some->berat_badan;
            }
            // return json_encode($grafik,JSON_NUMERIC_CHECK);
            /////////

            if ($jk== "L") {
                $chart1 = Highcharts::title([
                    'text' => 'KMS Laki-Laki',
                ])
                ->subtitle([
                    'text' => 'Kartu Menuju Sehat',
                ])
                ->chart([
                    'backgroundcolor' => null,
                ])
                ->colors([
                    '#0c2959'
                ])
                ->xaxis([
                    'title' => [
                        'text' => 'Umur',
                    ],
                    'labels'     => [
                        'style' => [
                            'fontsize' => 12
                        ],
                    ],
                    'gridlinewidth' => 1,
                    'tickinterval' => 1
                ])
                ->yaxis([
                    'title' => [
                        'text' => 'Berat Badan'
                    ],
                    'labels'     => [
                        'style' => [
                            'fontsize' => 12
                        ],
                    ],
                    'gridlinewidth' => 1,
                    'tickinterval' => 1
                ])
                ->legend([
                    'enabled' => false
                ])
                ->plotOptions([
                    'series' => [
                        'label' => [
                            'connectorallowed' => false,
                        ],
                        'pointstart' => 0,
                        'marker' => [
                            'enabled' => false,
                        ],
                        'enablemousetracking' => false
                    ],
                    'candlestick' => [
                        'linecolor' => '#404048',
                    ],
                    'scatter' => [
                        'datalabels' => [
                            'enabled' => true
                        ],
                    ],
                ])
                ->series(
                    [
                        [
                            'name'  => 'BB Lebih',
                            'data'  => [5.0,6.5,7.9,8.9,9.6,10.3,10.9,11.3,11.8,12.2,12.5,12.9,13.2,13.5,13.8,14.2,14.5,14.8,15.1,15.4,15.7,16.0,16.3,16.6,16.9,17.2,17.5,17.9,18.2,18.4,18.8,19.0,19.3,19.6,19.9,20.2,20.4,20.7,21.0,21.2,21.5,21.8,22.1,22.4,22.6,22.9,23.2,23.5,23.8,24.1,24.3,24.6,24.9,25.2,25.5,25.8,26.1,26.4,26.7,27.0,27.3,],
                            'color' => '#f2f200'
                        ],
                        [
                            'name'  => 'BB Normal',
                            'data'  => [4.4,5.8,7.1,8.0,8.7,9.3,9.8,10.3,10.7,11.0,11.4,11.7,12.0,12.3,12.6,12.8,13.1,13.4,13.6,13.9,14.2,14.4,14.7,15.0,15.2,15.6,15.8,16.1,16.3,16.6,16.9,17.1,17.3,17.6,17.8,18.1,18.3,18.5,18.8,19.0,19.2,19.5,19.7,20.0,20.2,20.4,20.7,21.0,21.2,21.4,21.7,21.9,22.2,22.4,22.7,22.9,23.2,23.4,23.7,23.9,24.1],
                            'color' => '#39b500'
                        ],
                        [
                            'name'  => 'BB Kurang',
                            'data'  => [2.5,3.4,4.3,5.0,5.5,6.0,6.3,6.7,6.9,7.1,7.3,7.6,7.7,7.9,8.1,8.3,8.4,8.6,8.8,8.9,9.1,9.2,9.4,9.5,9.7,9.8,10.0,10.1,10.2,10.4,10.5,10.6,10.8,10.9,11.0,11.2,11.3,11.4,11.5,11.7,11.8,11.9,12.0,12.1,12.2,12.4,12.5,12.6,12.7,12.8,12.9,13.0,13.2,13.3,13.4,13.5,13.6,13.7,13.9,14.0,14.1],
                            'color' => '#39b500'
                        ],
                        [
                            'name'  => 'BB Sangat Kurang',
                            'data'  => [2.1,2.9,3.8,4.4,4.9,5.3,5.7,5.9,6.2,6.4,6.6,6.8,6.9,7.1,7.3,7.4,7.6,7.7,7.8,8.0,8.1,8.2,8.4,8.5,8.6,8.8,8.9,9.0,9.1,9.2,9.4,9.5,9.6,9.7,9.8,9.9,10.0,10.1,10.2,10.3,10.4,10.5,10.6,10.7,10.8,10.9,11.0,11.1,11.2,11.3,11.4,11.5,11.6,11.7,11.8,11.9,12.0,12.1,12.2,12.3,12.4,],
                            'color' => '#ff0000'
                        ],
                        [
                            'type' => 'scatter',
                            'marker' => [
                                'enabled' => true,
                                'symbol' => 'cross',
                                'fillcolor' => '#000',
                                'linecolor' => '#fff'
                            ],
                            'name' => 'Berat Badan',
                            'data' => $grafik
                        ]
                    ]
                )
                ->display();
            } else {
                $chart1 = Highcharts::title([
                    'text' => 'KMS Perempuan',
                ])
                ->subtitle([
                    'text' => 'Kartu Menuju Sehat',
                ])
                ->chart([
                    'backgroundcolor' => null,
                ])
                ->colors([
                    '#0c2959'
                ])
                ->xaxis([
                    'title' => [
                        'text' => 'Umur',
                    ],
                    'labels'     => [
                        'style' => [
                            'fontsize' => 12
                        ],
                    ],
                    'gridlinewidth' => 1,
                    'tickinterval' => 1
                ])
                ->yaxis([
                    'title' => [
                        'text' => 'Berat Badan'
                    ],
                    'labels'     => [
                        'style' => [
                            'fontsize' => 12
                        ],
                    ],
                    'gridlinewidth' => 1,
                    'tickinterval' => 1
                ])
                ->legend([
                    'enabled' => false
                ])
                ->plotOptions([
                    'series' => [
                        'label' => [
                            'connectorallowed' => false,
                        ],
                        'pointstart' => 0,
                        'marker' => [
                            'enabled' => false,
                        ],
                        'enablemousetracking' => false
                    ],
                    'candlestick' => [
                        'linecolor' => '#404048',
                    ],
                    'scatter' => [
                        'datalabels' => [
                            'enabled' => true
                        ],
                    ],
                ])
                ->series(
                    [
                        [
                            'name'  => 'BB Lebih',
                            'data'  => [4.8,6.2,7.4,8.4,9.2,9.8,10.4,10.9,11.4,11.8,12.2,12.5,12.9,13.2,13.6,13.9,14.2,14.5,14.8,15.1,15.4,15.7,16.0,16.3,16.6,17.0,17.3,17.6,17.9,18.3,18.6,18.9,19.2,19.5,19.8,20.1,20.4,20.8,21.1,21.4,21.8,22.1,22.4,22.8,23.1,23.4,23.8,24.1,24.5,24.8,25.2,25.5,25.9,26.2,26.5,26.9,27.3,27.6,27.9,28.3,28.6],
                            'color' => '#f2f200'
                        ],
                        [
                            'name'  => 'BB Normal',
                            'data'  => [4.2,5.5,6.6,7.5,8.2,8.8,9.3,9.8,10.2,10.5,10.9,11.2,11.5,11.8,12.1,12.4,12.6,12.9,13.2,13.5,13.7,14.0,14.3,14.6,14.9,15.1,15.4,15.7,16.0,16.2,16.5,16.8,17.0,17.3,17.6,17.9,18.1,18.4,18.7,19.0,19.2,19.5,19.8,20.1,20.4,20.7,20.9,21.2,21.5,21.8,22.1,22.4,22.7,22.9,23.2,23.5,23.8,24.1,24.4,24.6,24.9],
                            'color' => '#39b500'
                        ],
                        [
                            'name'  => 'BB Kurang',
                            'data'  => [2.4,3.1,3.9,4.5,5.0,5.4,5.7,6.0,6.2,6.5,6.7,6.9,7.0,7.2,7.4,7.6,7.7,7.9,8.1,8.2,8.4,8.6,8.7,8.9,9.0,9.2,9.3,9.5,9.7,9.8,10.0,10.1,10.3,10.4,10.5,10.7,10.8,10.9,11.1,11.2,11.3,11.4,11.6,11.7,11.8,12.0,12.1,12.2,12.3,12.4,12.6,12.7,12.8,12.9,13.0,13.2,13.3,13.4,13.5,13.6,13.7],
                            'color' => '#39b500'
                        ],
                        [
                            'name'  => 'BB Sangat Kurang',
                            'data'  => [2.0,2.8,3.4,4.0,4.4,4.8,5.1,5.3,5.6,5.8,6.0,6.1,6.3,6.4,6.6,6.8,6.9,7.0,7.2,7.3,7.5,7.6,7.8,7.9,8.1,8.2,8.3,8.5,8.6,8.8,8.9,9.0,9.1,9.2,9.4,9.5,9.6,9.7,9.8,10.0,10.1,10.2,10.3,10.4,10.5,10.6,10.7,10.8,10.9,11.0,11.1,11.2,11.3,11.4,11.5,11.6,11.7,11.8,11.9,12.0,12.1],
                            'color' => '#ff0000'
                        ],
                        [
                            'type' => 'scatter',
                            'marker' => [
                                'enabled' => true,
                                'symbol' => 'cross',
                                'fillcolor' => '#000',
                                'linecolor' => '#fff'
                            ],
                            'name' => 'Berat Badan',
                            'data' => $grafik
                        ]
                    ]
                )
                ->display();
            }

           
            if ($data) {
                if($vitamin == 'y'){
                    if($imunisasi == 'y'){
                        $result['status'] = true;
                        $result['message'] = $q1;
                        session()->flash('chart_timbangan',$chart1);
                        session()->flash('info_imun', $var_array);
                        session()->flash('dataKelamin', $dataKelamin);
                        session()->flash('grafik', json_encode($grafik,JSON_NUMERIC_CHECK));
                        
                    }else{
                        $result['status'] = true;
                        $result['message'] = $q1;
                        session()->flash('chart_timbangan',$chart1);
                        session()->flash('dataKelamin', $dataKelamin);
                        session()->flash('grafik', json_encode($grafik,JSON_NUMERIC_CHECK));
                    }
                }else{
                    if($imunisasi == 'y'){
                        $result['status'] = true;
                        $result['message'] = 'Data berhasil disimpan.';
                        session()->flash('chart_timbangan',$chart1);
                        session()->flash('info_imun', $var_array);
                        session()->flash('dataKelamin', $dataKelamin);
                        session()->flash('grafik', json_encode($grafik,JSON_NUMERIC_CHECK));
                    }else{
                        $result['status'] = true;
                        $result['message'] = 'Data Berhasil Disimpan. !';
                        session()->flash('chart_timbangan',$chart1);
                        session()->flash('dataKelamin', $dataKelamin);                        
                        session()->flash('grafik', json_encode($grafik,JSON_NUMERIC_CHECK));

                    }
                }

            } else {
                $result['status'] = false;
                $result['message'] = 'Data Gagal Disimpan.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data Timbangan Anak Bulan ini Sudah Ada.';

        }
        
        return $result;
    }

    public function delete(Request $request)
    {
        $check = TimbanganModel::where(['id' => $request->id])->first();

        if ($check) {
            $check->is_deleted = 1;

            if ($check->save()) {
                $result['status'] = true;
                $result['message'] = 'Data berhasil dihapus.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal dihapus.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data tidak ditemukan.';
        }

        return $result;
    }

    public function update(Request $request)
    {
        $check = TimbanganModel::where(['id' => $request->id])->first();

        if ($check) {
            $check['tanggal_pencatatan'] = $request->tanggal_pencatatan;
            $check['tinggi_badan'] = $request->tinggi_badan;
            $check['berat_badan'] = $request->berat_badan;
            $check['id_anak'] = $request->dataanak;

            if ($check->save()) {
                $result['status'] = true;
                $result['message'] = 'Data berhasil diubah.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal diubah.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data tidak ditemukan.';
        }

        return $result;
    }
}
