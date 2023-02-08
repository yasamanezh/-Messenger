<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pack;
use App\Traits\Model\Translations;

class Option extends Model
{
    use Translations;
    use HasFactory;
       protected $fillable = ['sort','status' ];
     public function packs()
    {
        return $this->belongsToMany(Pack::class);

    }
}
