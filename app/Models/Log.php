<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
        protected $fillable = ['user_id', 'url', 'actionType'];
    use HasFactory;
}
