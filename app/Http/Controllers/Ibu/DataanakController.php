<?php

namespace App\Http\Controllers\Ibu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


use App\Models\DataAnakModel;
use App\Models\DataIbuModel;
use App\Models\ImunisasiModel;
use App\Models\VitaminAModel;
use App\Models\TimbanganModel;
use Illuminate\Http\Request;
use Highcharts;

use Illuminate\Support\Facades\DB;


class DataanakController extends Controller
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
        
        $check = DataIbuModel::where('id_user', Auth::user()->id)->first();
        
        $data['list'] = DataAnakModel::where('id_ibu', $check->id_ibu)->get();
        $data['Ibu'] = DataIbuModel::all();
        
        return view('ibu.dataanak.index', $data);
        
    }

    public function insert(Request $request)
    {
        $checkibu = DataIbuModel::where('id_user', Auth::user()->id)->first();
        $check = DataAnakModel::where(['nik' => $request->nik])->where(['is_deleted' => 0])->first();

        if (!$check) {
            $insert['nik'] = $request->nik;
            $insert['nama_anak'] = $request->nama_anak;
            $insert['tmp_lhr'] = $request->tempat_lahir;
            $insert['tgl_lhr'] = $request->tanggal_lahir;
            $insert['jenkel'] = $request->jenkel;
            $insert['id_ibu'] = $checkibu->id_ibu;
            $insert['bb_lahir'] = $request->berat_badan;
            $insert['tb_lahir'] = $request->tinggi_badan;
            $insert['anak_ke'] = $request->anak_ke;
            $insert['is_deleted'] = 0;
           

            if (DataAnakModel::create($insert)) {
                $result['status'] = true;
                $result['message'] = 'Data berhasil disimpan.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal disimpan.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data anak sudah ada.';
        }
        
        return $result;
    }

    public function update(Request $request)
    {
        $check = DataAnakModel::where(['id_anak' => $request->id])->first();

        if ($check) {
            $check->nik = $request->nik;
            $check->nama_anak = $request->name;
            $check->tmp_lhr = $request->tempat_lahir;
            $check->tgl_lhr = $request->tanggal_lahir;
            $check->jenkel = $request->jenkel;
            $check->bb_lahir = $request->berat_badan;
            $check->tb_lahir = $request->tinggi_badan;
            $check->anak_ke = $request->anak_ke;
            
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

    function getdata(Request $request)
    {
        $data['list'] = DataAnakModel::where(['id_anak' => $request->id])->with('Dataibu')->first();
        $data['imun'] = ImunisasiModel::where(['id_anak' => $request->id])->with('data_anak')->with('vaksin')->get();
        $data['vitA'] = VitaminAModel::where(['id_anak' => $request->id])->with('data_anak')->get();
        


        $t = DB::table('tb_anak as A')
                ->leftjoin('tb_timbangan as T', 'A.id_anak', '=', 'T.id_anak')
                ->select('A.id_anak', 'A.nama_anak', 'T.umur', 'T.berat_badan', 'T.tinggi_badan', 'T.tanggal_pencatatan')
                ->where('A.id_anak', $request->id)
                ->get();
        $grafik = array(61);
        for ($i=0; $i <= 61; $i++) { 
            $grafik[$i] = null;
        }
        $grafik[0] = $data['list']->bb_lahir;
        foreach ($t as $some) {
            $grafik[$some->umur] = $some->berat_badan;
        }
        // dd($grafik);

        if ($data['list']->jenkel == "L") {
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

        $data['chart_timbangan'] = $chart1;
        $data['grafik_timbangan'] = json_encode($grafik, JSON_NUMERIC_CHECK);
        
        return view('ibu.dataanak.detail', $data);
    }



}
