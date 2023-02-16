<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
 
    use HasFactory;
 

    protected $guarded = [];

    protected $table = 'ltu_phrases';

    protected $casts = [
        'parameters' => 'array',
    ];

   

}
