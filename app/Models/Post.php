<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translate;
use App\Models\Language;

class Post extends Model {

    protected $fillable = ['slug', 'image', 'thumbnail', 'status','blog_id'];

    use HasFactory;

    public function blogs() {
        return $this->belongsToMany(Blog::class);
    }

    public function translate() {
        return $this->morphMany(Translate::class, 'translateable');
    }

     
    public function currentTranslate()
    {
        $lang    = app()->getLocale();    
        $lang_id = Language::where('code',$lang)->pluck('id')->first();        
       
        if($lang_id){
            return $this->morphMany(Translate::class, 'translateable')->where('language_id',$lang_id)->first();            
        }        
    }

}
