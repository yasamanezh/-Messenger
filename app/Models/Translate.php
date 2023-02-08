<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    protected $fillable = ['title','content','short_content','meta_keyword','meta_title','meta_description','language_id','meta' ];
    
    use HasFactory;
    
     public function translateable()
    {
        return $this->morphTo();
    }
     public function translateableOption()
    {
        return $this->morphTo()->where('type','feature');
    }
    
    public function translateableClient()
    {
        return $this->morphTo()->where('type','client');
    }
     public function translateableBySlug($slug)
    {
        return $this->morphTo()->where('status',1)->where('slug',$slug);
    }
    
     
    
}



