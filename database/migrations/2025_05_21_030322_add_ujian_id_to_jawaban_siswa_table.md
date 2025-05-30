<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('jawaban_siswa', function (Blueprint $table) {
        $table->unsignedBigInteger('ujian_id')->after('user_id');

        // Optional: tambahkan foreign key
        $table->foreign('ujian_id')->references('id')->on('ujian')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('jawaban_siswa', function (Blueprint $table) {
        $table->dropForeign(['ujian_id']);
        $table->dropColumn('ujian_id');
    });
}

};
