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
        Schema::create('anggota_ekskuls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekstrakurikuler_id');
            $table->foreignId('siswa_id');
            $table->enum('predikat', ['A', 'B', 'C', 'D'])->default('B')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_ekskuls');
    }
};
