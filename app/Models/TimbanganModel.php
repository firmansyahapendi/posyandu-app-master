<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TimbanganModel extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_timbangan';
    protected $primaryKey = 'id';

    protected $guarded = [];
    
    public function Dataanak()
    {
        return $this->belongsTo(DataAnakModel::class, 'id_anak');
    }
}
