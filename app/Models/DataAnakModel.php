<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataAnakModel extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_anak';
    protected $primaryKey = 'id_anak';

    protected $guarded = [];
    
    public function Dataibu()
    {
        return $this->belongsTo(DataIbuModel::class, 'id_ibu');
    }
}
