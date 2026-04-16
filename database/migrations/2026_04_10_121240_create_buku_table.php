<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Reverse the migrations.
     */
   public function up(): void
{
    Schema::create('buku', function (Blueprint $table) {
        $table->id('id_buku');
        $table->string('judul_buku');
        $table->string('pengarang')->nullable();
        $table->string('penerbit')->nullable();
        $table->integer('tahun_terbit')->nullable();
        $table->unsignedBigInteger('id_kategori')->nullable();
        $table->string('cover')->nullable();
        $table->integer('jumlah_buku')->default(0);
        $table->string('file_buku')->nullable();
        $table->text('sinopsis')->nullable();
        $table->timestamps();

        $table->foreign('id_kategori')
              ->references('id_kategori')
              ->on('kategori_buku')
              ->onDelete('set null');
    });
}

public function down(): void
{
    Schema::dropIfExists('buku');
}
};
