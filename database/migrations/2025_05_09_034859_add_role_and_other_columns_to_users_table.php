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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['murid', 'guru', 'admin'])->default('murid')->after('password');
            $table->string('kelas')->nullable()->after('role');
            $table->string('jurusan')->nullable()->after('kelas');
            $table->string('nip')->nullable()->after('jurusan');
            $table->text('mata_pelajaran_diampu')->nullable()->after('nip');
            // $table->timestamps();

            // Tambahkan kolom lain jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'kelas', 'jurusan', 'nip', 'mata_pelajaran_diampu']);
            // Drop kolom lain yang kamu tambahkan di method 'up'
        });
    }
};