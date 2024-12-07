<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bagiRaport()
    {
      return $this->hasOne(Bagiraport::class, 'tapel_id', 'id');
    }

    public function ekstrakurikuler()
    {
      return $this->hasMany(Ekstrakurikuler::class, 'tapel_id', 'id');
    }

    public function kelas()
    {
      return $this->hasMany(Kelas::class, 'tapel_id', 'id');
    }

    public function mapel()
    {
      return $this->hasMany(Mapel::class, 'tapel_id', 'id');
    }

    public function nilaiSpiritual()
    {
      return $this->hasMany(nilaiSpiritual::class, 'tapel_id', 'id');
    }

    public function nilaiSosial()
    {
      return $this->hasMany(nilaiSosial::class, 'tapel_id', 'id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'tapel_id', 'id');
    }
}
