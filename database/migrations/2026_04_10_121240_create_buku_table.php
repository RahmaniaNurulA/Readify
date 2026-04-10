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
        $table->id();
        $table->string('judul');
        $table->string('penulis')->nullable();
        $table->string('penerbit')->nullable();
        $table->integer('tahun_terbit')->nullable();
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('buku');
}
};
