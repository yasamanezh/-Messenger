<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Part extends Model
{
    use Translations;
    use HasFactory;
    protected $fillable=['status'];
        
  
}
