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
         Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained('ujian');
            $table->foreignId('kategori_soal_id')->nullable()->constrained('kategori_soal');
            $table->text('pertanyaan');
            // $table->foreignId('tugas_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('jenis_soal', ['pg', 'esai', 'isian', 'menjodohkan'])->default('pg');
            $table->decimal('skor', 5, 2)->default(1);
            $table->integer('waktu_pengerjaan')->nullable();
            $table->string('gambar_pertanyaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
