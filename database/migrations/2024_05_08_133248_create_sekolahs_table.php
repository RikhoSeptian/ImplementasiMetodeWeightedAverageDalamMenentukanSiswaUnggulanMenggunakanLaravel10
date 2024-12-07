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
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('npsn', 20);
            $table->string('nss', 20)->nullable();
            $table->string('kodepos', 10);
            $table->string('telepon', 13)->nullable();
            $table->text('alamat');
            $table->string('website', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('logo')->default('logo.png');
            $table->string('kepsek', 50);
            $table->string('nuptkkepsek', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
