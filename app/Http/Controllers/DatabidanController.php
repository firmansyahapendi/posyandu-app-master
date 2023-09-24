<?php

namespace App\Http\Controllers;

use App\Models\DataBidanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DatabidanController extends Controller
{
    public function index()
    {
        $data['list'] = DataBidanModel::where(['is_deleted' => 0])->get();
        return view('admin.databidan.index', $data);
    }

    public function insert(Request $request)
    {
        $check = DataBidanModel::where(['nip' => $request->nip])->where(['is_deleted' => 0])->first();

        if (!$check) {
            $check_user = UserModel::where(['username' => $request->username])->first();
            if(!$check_user){
                $user = new UserModel();
                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->role = 'admin';
                $user->status = 1;
                $user->save();
            } else {
                $result['status'] = false;
                $result['message'] = 'Username sudah ada.';
                return $result;
            }
            
            $insert['id_user'] = $user->id;         
            $insert['nip'] = $request->nip;
            $insert['nama_bidan'] = $request->name;
            $insert['alamat'] = $request->alamat;
            $insert['no_hp'] = $request->no_hp;
            
            if (DataBidanModel::create($insert)) {
                $result['status'] = true;
                $result['message'] = 'Data berhasil disimpan.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal disimpan.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data Bidan sudah ada.';
        }
        
        return $result;
    }

    public function delete(Request $request)
    {
        $check = DataBidanModel::where(['id_bidan' => $request->id])->with('User')->first();

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
        $check = DataBidanModel::where(['id_bidan' => $request->id])->with('User')->first();

        if ($check) {
            $check->User->username = $request->username;
            if($request->password != null)
            {
                $check->User->password = bcrypt($request->password);
            }
            $check->User->save();

            $check->nip = $request->nip;
            $check->nama_bidan = $request->name;
            $check->alamat = $request->alamat;
            $check->no_hp = $request->no_hp;


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
