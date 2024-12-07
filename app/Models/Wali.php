<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
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

    public function siswa()
    {
      return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
