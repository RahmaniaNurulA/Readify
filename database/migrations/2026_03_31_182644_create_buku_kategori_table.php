<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku_kategori', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_kategori');
            $table->primary(['id', 'id_kategori']);
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_buku')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buku_kategori');
    }
};