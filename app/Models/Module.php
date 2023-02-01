<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{ModuleOption,Attach};


class Module extends Model
{
    protected $fillable=['file1','fille2','type','meta','more_link'];
    
    use HasFactory;

    public function options()
    {
        return $this->belongsToMany(ModuleOption::class);

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
     public function customTranslate($lang)
    {

        $lang_id = Language::where('code',$lang)->pluck('id')->first();        
       
        if($lang_id){
            return $this->morphMany(Translate::class, 'translateable')->where('language_id',$lang_id)->first();            
        }        
    }
    public function attach() {
        return $this->morphMany(Attach::class, 'attacheable');
    }
}
