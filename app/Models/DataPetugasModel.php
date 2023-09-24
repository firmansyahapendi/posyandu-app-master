<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataPetugasModel extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_petugas';
    protected $primaryKey = 'id_petugas';

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(UserModel::class, 'id_user');
    }
}
