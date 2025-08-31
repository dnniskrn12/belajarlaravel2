<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pend_Magang extends Model
{
    use HasFactory;
    protected $table = 'pend_magang';
    protected $primaryKey = 'id_pend_mag';
    protected $fillable = ['no_magang', 'id_jjg', 'nama_pend', 'thn_pend'];

    public function magang()
    {
         return $this->belongsTo(Magang::class, 'no_magang', 'no_magang');
    }

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jjg');
    }
}
