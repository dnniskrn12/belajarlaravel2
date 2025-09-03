<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk_Kerja extends Model
{
    use HasFactory;

    protected $table = 'sk_kerja';

    protected $fillable = [
        'no_sk',
        'no_pegawai',
        'nama_pegawai',
        'tgl_sk',
        'id_jabatan',
        'id_unitkerja',
        'id_lokasi',
    ];

    // Relasi ke Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'no_pegawai', 'no_pegawai');
    }

    // Relasi ke Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id');
    }

    // Relasi ke Unit Kerja
    public function unitkerja()
    {
        return $this->belongsTo(Unit_Kerja::class, 'id_unitkerja', 'id');
    }

    // Relasi ke Lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
}
