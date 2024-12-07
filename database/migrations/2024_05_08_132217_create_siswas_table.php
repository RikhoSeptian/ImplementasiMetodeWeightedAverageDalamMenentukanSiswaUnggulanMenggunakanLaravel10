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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kelas_id')->nullable();
            $table->string('name', 50);
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->enum('jenispendaftaran', ['1','2'])->nullable();
            $table->date('diterimapada')->nullable();
            $table->string('nis', 8)->unique()->nullable();
            $table->string('nisn', 10)->unique()->nullable();
            $table->string('tempatlahir', 20)->nullable();
            $table->date('tanggallahir')->nullable();
            $table->enum('agama', ['1','2','3','4','5'])->nullable();
            $table->enum('statusdalamkeluarga', ['1','2'])->nullable();
            $table->bigInteger('anak_ke')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 13)->nullable();
            $table->string('namaayah', 50)->nullable();
            $table->string('namaibu', 50)->nullable();
            $table->string('pekerjaanayah', 25)->nullable();
            $table->string('pekerjaanibu',25)->nullable();
            $table->string('namawali', 50)->nullable();
            $table->string('pekerjaanwali', 25)->nullable();
            $table->text('foto')->default('default.jpg');
            $table->enum('status', ['1','2','3']);
            $table->timestamps();

            // Jenis Pendaftaran
            // 1 = Siswa Baru
            // 2 = Pindahan

            // Agama
            // 1 = Islam
            // 2 = Protestan
            // 3 = Katolik
            // 4 = Hindu
            // 5 = Budha

            // Status Dalam Keluarga
            // 1 = Anak Kandung
            // 2 = Anak Angkat
            // 3 = Anak Tiri

            // Status
            // 1 = Aktif
            // 2 = Non-Aktif
            // 3 = Lulus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
