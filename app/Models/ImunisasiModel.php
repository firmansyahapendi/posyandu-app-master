<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ImunisasiModel extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_imunisasi';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function data_anak()
    {
        return $this->belongsTo(DataAnakModel::class, 'id_anak');
    }

    public function vaksin()
    {
        return $this->belongsTo(VaksinModel::class, 'id_vaksin');
    }
}
