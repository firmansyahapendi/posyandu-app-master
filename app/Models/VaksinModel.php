<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class VaksinModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_vaksin_imun';
    protected $primaryKey = 'id_vaksin';

    protected $guarded = [];
}
