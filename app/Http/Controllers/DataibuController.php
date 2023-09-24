<?php

namespace App\Http\Controllers;

use App\Models\DataIbuModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DataibuController extends Controller
{
    public function index()
    {
        $data['list'] = DataIbuModel::where(['is_deleted' => 0])->with('User')->get();
        return view('admin.dataibu.index', $data);
    }

    public function insert(Request $request)
    {
        $check = DataIbuModel::where(['nik' => $request->nik])->where(['is_deleted' => 0])->first();

        if (!$check) {
            $check_user = UserModel::where(['username' => $request->username])->first();
            if(!$check_user){
                $user = new UserModel();
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->role = 'ibu';
                $user->status = 1;
                $user->save();
            } else {
                $result['status'] = false;
                $result['message'] = 'Username sudah ada.';
                return $result;
            }
            
            $insert['id_user'] = $user->id;         
            $insert['nik'] = $request->nik;
            $insert['nama_ibu'] = $request->name;
            $insert['nama_suami'] = $request->name_suami;
            $insert['tmp_lhr'] = $request->tempat_lahir;
            $insert['tgl_lhr'] = $request->tanggal_lahir;
            $insert['alamat'] = $request->alamat;
            $insert['no_hp'] = $request->no_hp;
            $insert['pekerjaan_suami'] = $request->pek_suami;
            $insert['pekerjaan'] = $request->pekerjaan;
            
            if (DataIbuModel::create($insert)) {
                $result['status'] = true;
                $result['message'] = 'Data berhasil disimpan.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal disimpan.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data Ibu sudah ada.';
        }
        
        return $result;
    }

    public function delete(Request $request)
    {
        $check = DataIbuModel::where(['id_ibu' => $request->id])->with('User')->first();

        if ($check) {
            $check->User->status = 0;
            $check->User->is_deleted = 1;
            $check->User->save();
            
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

    function aktivasi(Request $request)
    {
        $check = UserModel::where(['id' => $request->id])->first();

        if ($check) {
            $check->status = $request->status;

            if ($check->save()) {
                if($request->status == 1){
                    $result['status'] = true;
                    $result['message'] = 'Data berhasil diaktivasi.';
                } else {
                    $result['status'] = true;
                    $result['message'] = 'Data berhasil dinonaktifkan.';
                }                
            } else {
                if($request->status == 1){
                    $result['status'] = false;
                    $result['message'] = 'Data gagal diaktivasi.';
                } else {
                    $result['status'] = false;
                    $result['message'] = 'Data gagal dinonaktifkan.';
                }
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data tidak ditemukan.';
        }

        return $result;
    }

    public function getdata(Request $request)
    {
        $data['list'] = DataIbuModel::where(['id_ibu' => $request->id])->with('User')->first();

        return view('admin.dataibu.detail', $data);
    }
}
