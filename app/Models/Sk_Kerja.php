<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit_Kerja;
use App\Models\Lokasi;
use App\Models\Jabatan;

class Sk_Kerja extends Model
{
    use HasFactory;

    protected $table = 'sk_kerja';

    protected $fillable = [
        'no_sk',
        'no_pegawai',
        'nama_pegawai',
        'tgl_sk',
        'id_lokasi',
        'id_unitkerja',
        'id_jabatan'
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }

    public function unitkerja()
    {
        return $this->belongsTo(Unit_Kerja::class, 'id_unitkerja');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
