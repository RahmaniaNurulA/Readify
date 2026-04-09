<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'role',
        'tanggal_daftar',
        'last_login',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke member
    public function member()
    {
        return $this->hasOne(Member::class, 'id_user', 'id_user');
    }
}