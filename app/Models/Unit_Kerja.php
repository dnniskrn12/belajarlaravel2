<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit_Kerja extends Model
{
    protected $table = 'unit_kerja';

    protected $fillable = [
        'id_unitkerja',
        'nama_unitkerja',
    ];
}
