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
        if (!Schema::hasTable('buku_kategori')) {
        Schema::create('buku_kategori', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_kategori');
            $table->timestamps();
        });
    }
    }

    public function down()
    {
        Schema::dropIfExists('buku_kategori');
    }
};