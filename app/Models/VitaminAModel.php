<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class VitaminAModel extends Authenticatable
{
    use Notifiable;

    protected $guar  = "web";
    protected $table = 'tb_vitaminA';
    protected $primaryKey = 'id_vitA';

    protected $guarded = [];

    public function data_anak()
    {
        return $this->belongsTo(DataAnakModel::class, 'id_anak');
    }
}
