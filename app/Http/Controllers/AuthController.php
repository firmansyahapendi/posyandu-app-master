<?php

namespace App\Http\Controllers;

use App\Models\DataIbuModel;
use App\Models\UserModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SNMP;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            if(Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif(Auth::user()->role == 'ibu') {
                return redirect()->route('ibu.dashboard');
            } elseif(Auth::user()->role == 'bidan') {
                return redirect('bidan');
            } else {
                return redirect()->route('login');
            }
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $checkAccount = UserModel::where(['username' => $request->username])->first();

        if ($checkAccount) {
            if ($checkAccount->status == 1) {
                Auth::attempt(['username' => $request->username, 'password' => $request->password]);
                if (Auth::check()) {
                    return response()->json([
                        'role' => Auth::user()->role,
                        'status' => true
                    ], 200);
                } else {
                    $result['status'] = false;
                    $result['message'] = "Username atau Password Salah.";
                }
            } else {
                $result['status'] = false;
                $result['message'] = 'Akun Anda tidak aktif, harap hubungi admin.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data user tidak ditemukan.';
        }

        return $result;
    }

    public function register()
    {
        return view('register');
    }
    
    public function registerStore(Request $request)
    {
        $check = UserModel::where(['username' => $request->username])->first();

        if (!$check) {
            $insert['username'] = $request->username;
            $insert['password'] = bcrypt($request->password);
            $insert['role'] = 'ibu';
            $insert['status'] = 0;

            if (UserModel::create($insert)) {
                $data = new DataIbuModel();
                $data->id_user = UserModel::where(['username' => $request->username])->first()->id;
                $data->nik = $request->nik;
                $data->nama_ibu = $request->nama;
                $data->save();


                $result['status'] = true;
                $result['message'] = 'Registrasi berhasil.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Registrasi gagal.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Username sudah ada.';
        }

        return $result;
    }

    public function logout()
    {
        if (Auth::check()) {
            session()->flush();
            Auth::logout();
        }

        return true;
    }

}
