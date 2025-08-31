<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'user_code',
        'status',
        'is_blocked',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi ke Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Auto-generate user_code sebelum simpan
    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->user_code) {
                $lastUser = self::latest('id')->first();
                $number = $lastUser ? intval(substr($lastUser->user_code, 3)) + 1 : 1;
                $user->user_code = 'USR' . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
