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
    Schema::create('bank_pilihan_jawabans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bank_soal_id')->constrained()->onDelete('cascade');
        $table->string('jawaban');
        $table->boolean('benar')->default(false);
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_pilihan_jawabans');
    }
};
