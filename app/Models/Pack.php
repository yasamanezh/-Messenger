<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
class Pack extends Model
{
    use HasFactory;
     protected $fillable = ['sort','status','price' ];
       public function options()
    {
        return $this->belongsToMany(Option::class);

    }
        
     public function translate()
    {
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
