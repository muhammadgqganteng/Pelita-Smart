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
        Schema::table('tugas', function (Blueprint $table) {
                      $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel guru

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Hapus foreign key constraint
            $table->dropColumn('user_id'); // Hapus kolom
        });
    }
};
