<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
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

    public function ekstrakurikuler()
    {
      return $this->hasMany(Ekstrakurikuler::class, 'guru_id', 'id');
    }

    public function kelas()
    {
      return $this->hasOne(Kelas::class, 'guru_id', 'id');
    }

    public function pembelajaran()
    {
      return $this->hasMany(Pembelajaran::class, 'guru_id', 'id');
    }
}
