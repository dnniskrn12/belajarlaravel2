<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Jenjang extends Model
{
    use HasFactory;
    protected $table = 'jenjang';
    protected $primaryKey = 'id_jjg';
    protected $fillable = ['nama_jenjang'];

    public function pendidikans()
    {
        return $this->hasMany(Pend_Pegawai::class, 'id_jjg');
    }
}

