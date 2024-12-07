<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPts extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelajaran()
    {
      return $this->belongsTo(Pembelajaran::class, 'pembelajaran_id', 'id');
    }

    public function siswa()
    {
      return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
