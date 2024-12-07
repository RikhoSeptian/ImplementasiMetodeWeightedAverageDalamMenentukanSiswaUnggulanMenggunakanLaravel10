<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function getUser()
    // {
    //     return $this->morphMany(User::class, 'getUser');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function anggotaEkskul()
    {
      return $this->hasMany(AnggotaEkskul::class, 'siswa_id', 'id');
    }

    public function catatanWalkel()
    {
      return $this->hasOne(Catatanwalikelas::class, 'siswa_id', 'id');
    }

    public function kehadiran()
    {
        return $this->hasOne(Kehadiran::class, 'siswa_id', 'id');
    }

    public function nilaiKeterampilan()
    {
      return $this->hasMany(NilaiKeterampilan::class, 'siswa_id', 'id');
    }

    public function nilaiPengetahuan()
    {
      return $this->hasMany(NilaiPengetahuan::class, 'siswa_id', 'id');
    }

    public function nilaiPts()
    {
      return $this->hasMany(NilaiPts::class, 'siswa_id', 'id');
    }

    public function nilaiPas()
    {
      return $this->hasMany(NilaiPas::class, 'siswa_id', 'id');
    }

    public function nilaiSpiritual()
    {
      return $this->hasMany(nilaiSpiritual::class, 'siswa_id', 'id');
    }

    public function nilaiSosial()
    {
      return $this->hasMany(nilaiSosial::class, 'siswa_id', 'id');
    }

    public function prestasi()
    {
      return $this->hasMany(Prestasi::class, 'siswa_id', 'id');
    }

    public function kelas()
    {
      return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function wali()
    {
        return $this->hasMany(Wali::class, 'siswa_id', 'id');
    }

    public function nilaiakhir()
    {
      return $this->hasMany(NilaiAkhir::class, 'pembelajaran_id', 'id');
    }
}
