<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pend_Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pend_pegawai';
    protected $primaryKey = 'id_pend_pgw';
    protected $fillable = ['no_pegawai', 'id_jjg', 'nama_pend', 'thn_pend'];

    public function pegawai()
    {
         return $this->belongsTo(Pegawai::class, 'no_pegawai', 'no_pegawai');
    }

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jjg');
    }
}
