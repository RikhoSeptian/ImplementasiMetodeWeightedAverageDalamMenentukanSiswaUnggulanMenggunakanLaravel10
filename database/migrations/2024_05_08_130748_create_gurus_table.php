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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name', 50);
            $table->string('gelar', 20)->nullable();
            // $table->string('nip', 20)->nullable();
            $table->string('nuptk', 20)->nullable();
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('tempatlahir', 20)->nullable();
            $table->date('tanggallahir')->nullable();
            $table->string('telepon', 13)->nullable();
            $table->text('alamat')->nullable()->default('default');
            $table->text('foto')->nullable()->default('default.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
