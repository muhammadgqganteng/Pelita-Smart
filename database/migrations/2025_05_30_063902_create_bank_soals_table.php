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
Schema::create('bank_soals', function (Blueprint $table) {
    $table->id();
    $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
    $table->enum('jenis_soal', ['pg', 'esai']);
    $table->text('pertanyaan');
    $table->integer('skor')->default(1);
    $table->timestamps();
});

     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_soals');
    }
};
