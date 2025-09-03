<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk_Magang extends Model
{
    use HasFactory;

    protected $table = 'sk_magang';

    protected $fillable = [
        'no_sk',
        'no_magang',
        'nama_siswa',
        'tgl_sk',
        'id_unitmagang',
    ];

    // Relasi ke Magang
    public function magang()
    {
        return $this->belongsTo(Magang::class, 'no_magang', 'no_magang');
    }

    // Relasi ke Unit Kerja
    public function unitmagang()
    {
        return $this->belongsTo(Unit_Magang::class, 'id_unitmagang', 'id');
    }


}
