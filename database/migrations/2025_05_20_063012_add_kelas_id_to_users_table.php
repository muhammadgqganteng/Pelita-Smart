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
// Tambahkan kolom foreign key untuk kelas_id
$table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null');
// Gunakan nullable() jika Anda tidak ingin semua user (misalnya admin/guru) punya kelas_id
// atau pastikan semua user punya kelas_id jika wajib.
});
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['kelas_id']); // Hapus foreign key constraint
        $table->dropColumn('kelas_id'); // Hapus kolom
    });
}
};