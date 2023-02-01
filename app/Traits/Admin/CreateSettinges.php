<?php

namespace App\Traits\Admin;
use App\Repositories\Contract\ILog;
use Illuminate\Support\Facades\Gate;

trait CreateSettinges {
   
    public function __construct() {
        $this->languages = $this->getInterface()->getLanguage();
         
    }
    
    public function starterDate($params) {
        foreach ($this->languages as $value) {
            
            foreach ($params as $param){
                if (is_array($param)) {
                    foreach ($param as $value1) {
                        $this->$value1[$value->language->code] = '';
                    }
                } else {
                   $this->$param[$value->language->code] = '';
                   }
            }
        }
    }
    
    public function getTranslate($params) {
        $translations =[];
        foreach ($this->languages as $lan) {
            $items =[];
             $meta = [];
            foreach ($params as $param) {
                if (is_array($param)) {
                    foreach ($param as $value) {
                        if($this->$value[$lan->language->code]){
                         $meta[$value] = $this->$value[$lan->language->code];  
                       }
                       
                    }
                } elseif ($this->$param[$lan->language->code])
                    $items[$param] = $this->$param[$lan->language->code];
            }
            
            $lang = [
                'language_id'      => $lan->language->id
            ];
           if (!empty($items)) {
                if (!empty($meta)) {
                    $more =  ['meta'  => json_encode($meta)];
                    $translations[] = array_merge($items, $lang, $more);
                } else {
                    $translations[] = array_merge($items, $lang);
                }
            }else{
                if (!empty($meta)) {
                    $more = ['meta' => json_encode($meta)];
                    $translations[] = array_merge($lang, $more);
                }
            }
    
        }
        return $translations;
        
    }
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    public function saveData() {
        
        $translates  = $this->getTranslate($this->Translateparams);
        $items       = $this->getItems();
        $this->getInterface()->create($items,$translates);

        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'create '. $this->typePage, 
           'url'         =>$this->typePage , 
        ]);

    }
    
    public function saveInfo() {
        if (Gate::allows('edit_'.$this->gate)) {
           $this->validate();
           $this->saveData();
           return (redirect(route($this->IndexRoute)))->with('sucsess', 'sucsess');
            
        } else {
           $this->emit('toast', 'warning', 'permission denied !');
           
        }
        
    }

}
