<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pend_Pegawai;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'no_pegawai',
        'nama_pegawai',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'no_hp',
        'email',
        'status_kwn',
        'status_pekerjaan',
        'tgl_masuk',
        'tgl_akhir',
        'foto',
    ];

    // Relasi pegawai ke pendidikan
    public function pend_pegawai()
    {
        return $this->hasMany(Pend_Pegawai::class, 'no_pegawai', 'no_pegawai');
    }

}
