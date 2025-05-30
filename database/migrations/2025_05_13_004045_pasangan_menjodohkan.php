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
                Schema::create('pasangan_menjodohkan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_id')->constrained('soal');
            $table->string('kiri');
            $table->string('kanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasangan_menjodohkan');
    }
};
