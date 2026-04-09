<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjam';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_batas_pinjam',
        'status_peminjaman',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function buku()
{
    return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
}
}