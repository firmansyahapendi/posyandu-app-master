<?php

namespace App\Http\Controllers;

use App\Models\VaksinModel;
use Illuminate\Http\Request;

class VaksinController extends Controller
{
    public function index()
    {
        $data['list'] = VaksinModel::where(['is_deleted' => 0])->get();
        return view('admin.vaksin.index', $data);
    }

    public function insert(Request $request)
    {
        $check = VaksinModel::where(['id_vaksin' => $request->nama_vaksin])->where(['is_deleted' => 0])->first();

        if (!$check) {
            $insert['nama_vaksin'] = $request->nama_vaksin;   
            $insert['umur'] = $request->umur;

            if (VaksinModel::create($insert)) {
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

    public function delete(Request $request)
    {
        $check = VaksinModel::where(['id_vaksin' => $request->id])->first();

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
        $check = VaksinModel::where(['id_vaksin' => $request->id])->first();

        if ($check) {
            $check->nama_vaksin = $request->nama_vaksin;
            $check->umur = $request->umur;

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
