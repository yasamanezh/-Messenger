<?php

namespace App\Traits\Model;
use App\Models\Language;
use App\Models\Translate;

trait Translations {

   
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
    
    public function customTranslate($lang) {
        $lang_id = Language::where('code',$lang)->pluck('id')->first();        
       
        if($lang_id){
            return $this->morphMany(Translate::class, 'translateable')->where('language_id',$lang_id)->first();            
        } 
    } 
    

}
