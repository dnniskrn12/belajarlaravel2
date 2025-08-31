<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $fillable = [
        'id_lokasi',
        'nama_lokasi',
        'alamat',
        'no_hp',
    ];
}
