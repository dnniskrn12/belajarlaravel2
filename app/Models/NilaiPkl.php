<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPKL extends Model
{
    use HasFactory;

    protected $table = 'nilai_pkl';

    protected $fillable = [
        'no_magang',
        'nilai_akhir',
        'catatan',
        'file_scan_nilai',
    ];

    /**
     * Relasi ke tabel Magang
     */
    public function magang()
    {
        return $this->belongsTo(Magang::class, 'no_magang', 'no_magang');
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class, 'id_nilai_pkl');
    }

}
