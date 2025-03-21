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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->enum('jenis', [1,2]);
            $table->text('keterangan');
            $table->timestamps();

            // Jenis Prestasi
            // 1 = Akademik
            // 2 = Non Akademik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
