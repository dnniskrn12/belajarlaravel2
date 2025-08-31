<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit_Magang extends Model
{
    protected $table = 'unit_magang';

    protected $fillable = [
        'id_unitmagang',
        'nama_unitmagang',
    ];
}
