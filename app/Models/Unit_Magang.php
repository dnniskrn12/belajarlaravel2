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

    public function skMagang()
    {
        return $this->hasMany(Sk_Magang::class, 'id_unitmagang');
    }
    public function nilai_pkl()
    {
        return $this->hasMany(NilaiPkl::class, 'id_unit_magang', 'id');
    }
}
