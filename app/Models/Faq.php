<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;
use App\Models\Translate;
use App\Models\Help;

class Faq extends Model
{
    use HasFactory;
        protected $fillable = ['slug', 'status','help_id'];

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
    
     public function help()
    {
        return $this->belongTo(Help::class);
    }
}
