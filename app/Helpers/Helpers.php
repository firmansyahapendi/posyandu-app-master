<?php

use Illuminate\Support\Carbon;

    function Tgl_Indo($tgl)
    {
        // $nama_bulan = array (
        //     1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
        //     "September", "Oktober", "November", "Desember");
        // $tahun=substr($tgl,0,4);
        // $bulan=$nama_bulan[(int)substr($tgl,5,2)];
        // $tanggal=substr($tgl,8,2);
        // $text =$tanggal ." ". $bulan ." ". $tahun;
        // return $text;
        if($tgl == null){
            return null;
        } else {
            $dt = new Carbon($tgl);
            // setlocale(LC_TIME, 'id_ID');
            
            // return $dt->formatLocalized('%e %B %Y');
            return $dt->isoFormat('D MMMM YYYY');
        }
    }

    function Hari($hari){
        $dt = new Carbon($hari);
		// setlocale(LC_TIME, 'id_ID');
		
		// return $dt->formatLocalized('%A');
        return $dt->isoFormat('dddd');
    }
    
