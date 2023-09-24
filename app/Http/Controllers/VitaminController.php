<?php

namespace App\Http\Controllers;

use App\Models\DataAnakModel;
use App\Models\VitaminAModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VitaminController extends Controller
{
    public function index()
    {
        $data['anak'] = DataAnakModel::all();
        $data['list'] = VitaminAModel::Select('tb_vitaminA.*','tb_anak.id_anak', 'tb_anak.nama_anak', 'tb_anak.tgl_lhr', 'tb_anak.jenkel', 'tb_ibu.nama_ibu', 'tb_ibu.nama_suami')
            ->join('tb_anak', 'tb_anak.id_anak', '=', 'tb_vitaminA.id_anak')
            ->join('tb_ibu', 'tb_ibu.id_ibu', '=', 'tb_anak.id_ibu')
            ->get();

        // return $data;
        return view('admin.vitamin.index', $data);
    }

    public function update (Request $request)
    {
        $check = VitaminAModel::where(['id_vitA' => $request->id])->first();

        if($check){
            $check->id_anak = $request->dataanak;
            $check->tgl_vitA = $request->tgl_vitA;
            $check->keterangan = $request->vitamin;

            if($check->save()){
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
