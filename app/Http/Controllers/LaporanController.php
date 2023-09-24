<?php

namespace App\Http\Controllers;

use App\Models\DataAnakModel;
use App\Models\VitaminAModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

}
