<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pend_Magang;

class Magang extends Model
{
    use HasFactory;

    protected $table = 'magang';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'no_magang',
        'nama_siswa',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'no_hp',
        'email',
        'status_magang',
        'tgl_masuk',
        'tgl_akhir',
        'foto',
    ];

    // Relasi magang ke pendidikan
    public function pend_magang()
    {
        return $this->hasMany(Pend_Magang::class, 'no_magang', 'no_magang');
    }

}
