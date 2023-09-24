<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataIbuModel extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_ibu';
    protected $primaryKey = 'id_ibu';

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(UserModel::class, 'id_user');
    }
}
