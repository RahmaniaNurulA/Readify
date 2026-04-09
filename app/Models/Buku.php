<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model 
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';
    public    $timestamps = false;

    protected $fillable = ['judul_buku', 'pengarang', 'penerbit', 'tahun_terbit', 'id_kategori', 'cover', 'jumlah_buku', 'file_buku', 'sinopsis'];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'buku_kategori', 'id_buku', 'id_kategori');
    }
}