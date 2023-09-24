<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataBidanModel extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';
    protected $table = 'tb_bidan';
    protected $primaryKey = 'id_bidan';

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(UserModel::class, 'id_user');
    }
}
