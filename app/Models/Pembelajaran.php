<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelajaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nilaiKeterampilan()
    {
      return $this->hasMany(NilaiKeterampilan::class, 'pembelajaran_id', 'id');
    }

    public function nilaiPengetahuan()
    {
      return $this->hasMany(NilaiPengetahuan::class, 'pembelajaran_id', 'id');
    }

    public function nilaiPts()
    {
      return $this->hasMany(NilaiPts::class, 'pembelajaran_id', 'id');
    }

    public function nilaiPas()
    {
      return $this->hasMany(NilaiPas::class, 'pembelajaran_id', 'id');
    }

    public function kelas()
    {
      return $this->belongsTo(Kelas::class, 'kelas_id','id');
    }

    public function mapel()
    {
      return $this->belongsTo(Mapel::class, 'mapel_id','id');
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class, 'guru_id','id');
    }

    public function nilaiakhir()
    {
      return $this->hasMany(NilaiAkhir::class, 'pembelajaran_id', 'id');
    }
}
