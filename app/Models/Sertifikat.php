<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';
    public $timestamps = false;


    protected $fillable = [
        'id_nilai_pkl',
        'nomor_sertifikat',
        'tanggal_sertifikat',
        'file_sertifikat',
    ];
    public function magang()
    {
        return $this->belongsTo(Magang::class, 'no_magang', 'no_magang');
    }
    public function nilaiPkl()
    {
        return $this->belongsTo(NilaiPKL::class, 'id_nilai_pkl');
    }
}
