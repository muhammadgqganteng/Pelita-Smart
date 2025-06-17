<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     // wajib di komen
    public function up(): void
    {
        Schema::create('jawaban_ujian_murid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained('ujian')->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('soal')->onDelete('cascade');
            $table->foreignId('user_id')->constrained(); // ID murid
            $table->unsignedBigInteger('pilihan_jawaban_id')->nullable(); // Untuk soal PG
            $table->text('jawaban_esai')->nullable();       // Untuk soal Esai
            $table->timestamps();

            $table->unique(['ujian_id', 'soal_id', 'user_id'], 'unique_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_ujian_murid');
    }
};