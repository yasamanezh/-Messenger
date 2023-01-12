<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    protected $fillable = ['title','content','short_content','meta_keyword','meta_title','meta_description','language_id' ];
    
    use HasFactory;
    
     public function translateable()
    {
        return $this->morphTo();
    }
}



