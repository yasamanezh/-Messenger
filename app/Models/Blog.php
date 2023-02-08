<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Blog extends Model
{
    use Translations;
    protected $fillable = ['slug','status','blog_id' ,'archive'];
    
    use HasFactory;
    
    public function posts(){       
        return $this->hasMany(Post::class,'blog_id');
    }
     public function activePosts(){       
        return $this->hasMany(Post::class,'blog_id')->where('status',1);
    }
    
    
  
    
}
