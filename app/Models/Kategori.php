<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table      = 'kategori_buku';
    protected $primaryKey = 'id_kategori';
    public    $timestamps = false;

    protected $fillable = ['nama_kategori'];

    // Relasi many-to-many ke Buku melalui tabel pivot buku_kategori
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'buku_kategori', 'id_kategori', 'id_buku');
    }
}