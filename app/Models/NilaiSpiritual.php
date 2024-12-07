<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSpiritual extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tapel()
    {
      return $this->belongsTo(Tapel::class, 'tapel_id', 'id');
    }

    public function siswa()
    {
      return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
