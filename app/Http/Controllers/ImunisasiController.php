<?php

namespace App\Http\Controllers;

use App\Models\VaksinModel;
use App\Models\ImunisasiModel;
use App\Models\DataAnakModel;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function index()
    {
        $data['list'] = ImunisasiModel::where(['is_deleted' => 0])->with('data_anak')->with('vaksin')->get();
        $data['anak'] = DataAnakModel::where(['is_deleted' => 0])->with('Dataibu')->get();
        $data['vaksin'] = VaksinModel::where(['is_deleted' => 0])->get();

        return view('admin.imunisasi.index', $data);
    }

    public function insert(Request $request)
    {

        $imun = $request->get('imunisasi');
        for ($i=0; $i < count($imun); $i++){
                $insert['id_anak'] = $request->dataanak;
                $insert['id_vaksin'] = $imun[$i];
                $insert['tanggal_imunisasi'] = $request->tgl_imunisasi;
                $insert['booster'] = $request->booster;
                $insert['keterangan'] = $request->keterangan;
                $insert['is_deleted'] = 0;
                ImunisasiModel::create($insert);                
        }
        if($insert){
            $result['status'] = true;
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $result['status'] = false;
            $result['message'] = 'Data gagal disimpan.';
        }

        return $result;
        
    }

    public function delete(Request $request)
    {
        $check = ImunisasiModel::where(['id' => $request->id])->first();

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
        $check = ImunisasiModel::where(['id' => $request->id])->first();

        if ($check) {
            $check->id_anak = $request->dataanak;
            $check->id_vaksin = $request->imunisasi;
            $check->tanggal_imunisasi = $request->tgl_imunisasi;
            $check->booster = $request->booster;
            $check->keterangan = $request->keterangan;

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
