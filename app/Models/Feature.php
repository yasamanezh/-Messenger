<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Feature extends Model
{
    use Translations;
    use HasFactory;
    protected $fillable = ['slug','icon','status'];

   
}
