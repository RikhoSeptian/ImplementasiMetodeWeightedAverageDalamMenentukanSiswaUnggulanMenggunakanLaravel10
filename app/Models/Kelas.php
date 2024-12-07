<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tapel()
    {
      return $this->belongsTo(Tapel::class, 'tapel_id', 'id');
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function pembelajaran()
    {
      return $this->hasMany(Pembelajaran::class, 'kelas_id', 'id');
    }

    public function siswa()
    {
      return $this->hasMany(Siswa::class, 'kelas_id', 'id');
    }
}
