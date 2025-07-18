<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ebook_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('chapters');
    }
};
