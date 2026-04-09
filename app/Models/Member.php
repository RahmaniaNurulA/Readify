<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_user',
        'nama',
        'nohp',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
    ];

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_user', 'id_user');
    }
}