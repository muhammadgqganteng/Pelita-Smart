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
        Schema::create('kategori_soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained('ujian');
            $table->string('nama_kategori', 100);
            $table->integer('jumlah_soal')->default(0);
            $table->integer('bobot')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_soal');
    }
};
