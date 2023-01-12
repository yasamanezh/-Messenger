<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['title', 'code', 'img', 'dir', 'status','language_id' ];
    use HasFactory;
}
