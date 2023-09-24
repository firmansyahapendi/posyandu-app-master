<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ibu\DashboardController as IbuDashboardController;
use App\Http\Controllers\ibu\DataanakController as IbuDataanakController;
use App\Http\Controllers\DataanakController;
use App\Http\Controllers\DataibuController;
use App\Http\Controllers\DataBidanController;
use App\Http\Controllers\DatapetugasController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\TimbanganController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\VitaminController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

Route::group(['middleware' => 'Userauth'], function () {
    Route::group(['roles'=>'admin'], function (){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::group(['prefix' => 'data-ibu'], function () {
            Route::get('/', [DataibuController::class, 'index'])->name('admin.dataibu.index');
            Route::post('/insert', [DataibuController::class, 'insert'])->name('admin.dataibu.insert');
            Route::put('/update', [DataibuController::class, 'update'])->name('admin.dataibu.update');
            Route::delete('/delete', [DataibuController::class, 'delete'])->name('admin.dataibu.delete');
            Route::get('/detail-ibu/{id}', [DataibuController::class, 'getdata'])->name('admin.dataibu.detail');
            Route::put('/aktivasi', [DataibuController::class, 'aktivasi'])->name('admin.dataibu.aktivasi');
        });

        Route::group(['prefix' => 'data-anak'], function () {
            Route::get('/', [DataanakController::class, 'index'])->name('admin.dataanak.index');
            Route::post('/insert', [DataanakController::class, 'insert'])->name('admin.dataanak.insert');
            Route::put('/update', [DataanakController::class, 'update'])->name('admin.dataanak.update');
            Route::delete('/delete', [DataanakController::class, 'delete'])->name('admin.dataanak.delete');
            Route::get('/detail-anak/{id}', [DataanakController::class, 'getdata'])->name('admin.dataanak.detailanak');
        });
        Route::group(['prefix' => 'timbangan'], function () {
            Route::get('/', [TimbanganController::class, 'index'])->name('admin.timbangan.index');
            Route::get('/create', [TimbanganController::class, 'createtimbangan'])->name('admin.timbangan.create');
            Route::post('/insert', [TimbanganController::class, 'insert'])->name('admin.timbangan.insert');
            Route::put('/update', [TimbanganController::class, 'update'])->name('admin.timbangan.update');
            Route::delete('/delete', [TimbanganController::class, 'delete'])->name('admin.timbangan.delete');
        });

        Route::group(['prefix' => 'data-vaksin'], function () {
            Route::get('/', [VaksinController::class, 'index'])->name('admin.vaksin.index');
            Route::post('/insert', [VaksinController::class, 'insert'])->name('admin.vaksin.insert');
            Route::put('/update', [VaksinController::class, 'update'])->name('admin.vaksin.update');
            Route::delete('/delete', [VaksinController::class, 'delete'])->name('admin.vaksin.delete');
        });
        Route::group(['prefix' => 'imunisasi'], function () {
            Route::get('/', [ImunisasiController::class, 'index'])->name('admin.imunisasi.index');
            Route::post('/insert', [ImunisasiController::class, 'insert'])->name('admin.imunisasi.insert');
            Route::put('/update', [ImunisasiController::class, 'update'])->name('admin.imunisasi.update');
            Route::delete('/delete', [ImunisasiController::class, 'delete'])->name('admin.imunisasi.delete');
        });
        Route::group(['prefix' => 'vitamin'], function () {
            Route::get('/', [VitaminController::class, 'index'])->name('admin.vitamin.index');
            Route::put('/update', [VitaminController::class, 'update'])->name('admin.vitamin.update');
        });

        Route::group(['prefix' => 'data-bidan'], function () {
            Route::get('/', [DataBidanController::class, 'index'])->name('admin.databidan.index');
            Route::post('/insert', [DataBidanController::class, 'insert'])->name('admin.databidan.insert');
            Route::put('/update', [DataBidanController::class, 'update'])->name('admin.databidan.update');
            Route::delete('/delete', [DataBidanController::class, 'delete'])->name('admin.databidan.delete');
        });
        Route::group(['prefix' => 'data-petugas'], function () {
            Route::get('/', [DatapetugasController::class, 'index'])->name('admin.datapetugas.index');
            Route::post('/insert', [DatapetugasController::class, 'insert'])->name('admin.datapetugas.insert');
            Route::put('/update', [DatapetugasController::class, 'update'])->name('admin.datapetugas.update');
            Route::delete('/delete', [DatapetugasController::class, 'delete'])->name('admin.datapetugas.delete');
        });
        Route::group(['prefix' => 'laporan'], function(){
            Route::get('/', [LaporanController::class, 'index'])->name('admin.laporan.index');
        });
    });

    Route::group(['roles'=>'ibu'], function (){
        Route::group(['prefix' => 'ibu'], function () {
            Route::get('/dashboard', [IbuDashboardController::class, 'index'])->name('ibu.dashboard');
            Route::get('/profile', [IbuDashboardController::class, 'detail'])->name('ibu.dataibu.detailibu');
            Route::get('/update-profile', [IbuDashboardController::class, 'update'])->name('ibu.dataibu.update');
            Route::post('/update-profile', [IbuDashboardController::class, 'updateprofile'])->name('ibu.dataibu.updateprofile');

            Route::group(['prefix' => 'data-anak'], function () {
                Route::get('/', [IbuDataanakController::class, 'index'])->name('ibu.dataanak.index');
                Route::post('/insert', [IbuDataanakController::class, 'insert'])->name('ibu.dataanak.insert');
                Route::put('/update', [IbuDataanakController::class, 'update'])->name('ibu.dataanak.update');
                Route::get('/detail-anak/{id}', [IbuDataanakController::class, 'getdata'])->name('ibu.dataanak.detailanak');

            });

        });
    });


    Route::group(['roles'=>'bidan'], function (){
        Route::group(['prefix' => 'binda'], function () {
            Route::get('/', function () {
                return "Hello World Bidan";
            });


        });
    });

});
