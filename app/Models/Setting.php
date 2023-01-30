<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;
use App\Models\Translate;

class Setting extends Model
{
    protected $fillable = ['logo','icon','location','daf_lang','mail_parameter','mail_username','mail_password' ];
    use HasFactory;
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
