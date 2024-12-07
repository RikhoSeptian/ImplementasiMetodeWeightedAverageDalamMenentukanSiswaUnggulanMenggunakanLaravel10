<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagiraport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tapel()
    {
      return $this->belongsTo(Tapel::class, 'tapel_id', 'id');
    }
}
