<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function anggotaEkskul()
    {
      return $this->hasMany(AnggotaEkskul::class, 'ekstrakurikuler_id', 'id');
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function tapel()
    {
      return $this->belongsTo(Tapel::class, 'tapel_id', 'id');
    }
}
