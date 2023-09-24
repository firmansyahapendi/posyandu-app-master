<?php

namespace App\Http\Controllers\Ibu;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Highcharts;

use App\Models\DataIbuModel;
use App\Models\DataAnakModel;



class DashboardController extends Controller
{
    
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function index()
    {
        $data['dataDiri'] = "1";
        $data['ibu'] = DataIbuModel::where(['id_user' => Auth::user()->id])->with('user')->first();
        if($data['ibu']['tmp_lhr'] == "" || $data['ibu']['tgl_lhr'] == "" || $data['ibu']['alamat'] == "" || $data['ibu']['no_hp'] == "" || $data['ibu']['pekerjaan'] == "" || $data['ibu']['nama_suami'] == "" || $data['ibu']['pekerjaan_suami'] == "" || $data['ibu']['alamat'] == "" || $data['ibu']['no_hp'] == "")
        {
            $data['dataDiri'] = "0";
        }

        // return $data['ibu'];

        $data['totalanak'] = DataAnakModel::count();
        $data['dataanak'] =  DataAnakModel::where(['id_ibu' => $data['ibu']['id_ibu']])->count();
        $data['dataanakl'] = DataAnakModel::where(['id_ibu' => $data['ibu']['id_ibu']])->where(['jenkel' => 'L'])->count();
        $data['dataanakp'] = DataAnakModel::where(['id_ibu' => $data['ibu']['id_ibu']])->where(['jenkel' => 'P'])->count();

        
        //Grafik

        date_default_timezone_set('Asia/Jakarta');
        $nmm = Carbon::now()->format('m'); // Tanggal sekarang bulan
        $nY = Carbon::now()->format('Y'); // Tanggal sekarang tahun
        $nm = [1,2,3,4,5,6,7,8,9,10,11,12];
        $t_lebih=[];
        $t_normal=[];
        $t_kurang=[];
        $t_s_kurang=[];
        
        foreach ($nm as $nowM) {

            $g_lebih = DB::table('tb_timbangan')
                ->whereMonth('tanggal_pencatatan', $nowM)
                ->whereYear('tanggal_pencatatan', $nY)
                ->where('status_gizi', '=', 'BB Lebih')
                ->count();


            $g_normal = DB::table('tb_timbangan')
                ->whereMonth('tanggal_pencatatan', $nowM)
                ->whereYear('tanggal_pencatatan', $nY)
                ->where('status_gizi', '=', 'BB Normal')
                ->count();

            $g_kurang = DB::table('tb_timbangan')
                ->whereMonth('tanggal_pencatatan', $nowM)
                ->whereYear('tanggal_pencatatan', $nY)
                ->where('status_gizi', '=', 'BB Kurang')
                ->count();

            $g_s_kurang = DB::table('tb_timbangan')
                ->whereMonth('tanggal_pencatatan', $nowM)
                ->whereYear('tanggal_pencatatan', $nY)
                ->where('status_gizi', '=', 'BB Sangat Kurang')
                ->count();
            
            array_push($t_lebih, $g_lebih);
            array_push($t_normal, $g_normal);
            array_push($t_kurang, $g_kurang);
            array_push($t_s_kurang, $g_s_kurang);
        }

        // GRAFIK /////////////////
        $data['chart1'] = Highcharts::title([
            'text' => 'Grafik Status Gizi Anak',
        ])
        ->chart([
            'type'     => 'column', // pie , columnt ect
            'renderTo' => 'chart1', // render the chart into your div with id
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'labels'     => [
                'style' => [
                    'fontsize' => 12
                ],
            ],
            'gridlinewidth' => 1,
            'tickinterval' => 1
        ])
        ->yaxis([
            'title' => 'Jumlah',
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
        ->plotoptions([
            'series' => [
                'label' => [
                    'connectorallowed' => 'false',
                ],
                'pointstart' => 0,
                'marker' => [
                    'enabled' => 'false',
                ],
                'enablemousetracking' => 'true'
            ],
            'candlestick' => [
                'linecolor' => '#404048',
            ],
            'scatter' => [
                'datalabels' => [
                    'enabled' => 'true'
                ],
            ],
        ])
        ->series(
            [
                [
                    'name'  => 'BB Lebih',
                    'data'  => $t_lebih,
                    'color' => '#f2f200'
                ],
                [
                    'name'  => 'BB Normal',
                    'data'  => $t_normal,
                    'color' => '#39b500'
                ],
                [
                    'name'  => 'BB Kurang',
                    'data'  => $t_kurang,
                    'color' => '#39b500'
                ],
                [
                    'name'  => 'BB Sangat Kurang',
                    'data'  => $t_s_kurang,
                    'color' => '#ff0000'
                ],
            ]
        )
        ->display();
 
        return view('ibu.dashboard.index', $data);
    }

    public function detail()
    {
        $data['dataDiri'] = "1";
        $data['ibu'] = DataIbuModel::where(['id_user' => Auth::user()->id])->with('user')->first();
        if($data['ibu']['tmp_lhr'] == "" || $data['ibu']['tgl_lhr'] == "" || $data['ibu']['alamat'] == "" || $data['ibu']['no_hp'] == "" || $data['ibu']['pekerjaan'] == "" || $data['ibu']['nama_suami'] == "" || $data['ibu']['pekerjaan_suami'] == "" || $data['ibu']['alamat'] == "" || $data['ibu']['no_hp'] == "")
        {
            $data['dataDiri'] = "0";
        }

        $data['list'] = DataIbuModel::where(['id_user' => Auth::user()->id])->with('user')->first();
        return view('ibu.dataibu.detail', $data);
    }

    public function update()
    {
        $data['list'] = DataIbuModel::where(['id_user' => Auth::user()->id])->with('user')->first();

        return view('ibu.dataibu.update', $data);
    }
    public function updateprofile(Request $request)
    {
        $check = DataIbuModel::where(['id_ibu' => $request->id])->first();

        if ($check) {
            $check->nik = $request->nik;
            $check->nama_ibu = $request->name;
            $check->nama_suami = $request->name_suami;
            $check->tmp_lhr = $request->tempat_lahir;
            $check->tgl_lhr = $request->tanggal_lahir;
            $check->alamat = $request->alamat;
            $check->no_hp = $request->no_hp;
            $check->pekerjaan = $request->pekerjaan;
            $check->pekerjaan_suami = $request->pek_suami;
            
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
