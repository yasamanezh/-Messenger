<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Comment,User};
use App\Traits\Model\Translations;

class Post extends Model {

    use Translations;

    protected $fillable = ['slug', 'image', 'thumbnail', 'status','archive', 'blog_id','userid','related'];

    use HasFactory;

    public function blog() {
        return $this->belongsTo(Blog::class,'blog_id');
    }
    

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function user() {
        return $this->beLongsTo(User::class,'userid');
    }
    

}
