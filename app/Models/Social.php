<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable=['github','linkdin','instagram','email','twitter'];
    use HasFactory;
}
