<?php

namespace App\Traits;


trait Translate {


    public function getTranslate($type, $item, $metaType = null) {
        if ($metaType) {
            if ($item->currentTranslate() && isset(json_decode($item->currentTranslate()->meta,true)[$type])) {
                return json_decode($item->currentTranslate()->meta,true)[$type];
            } elseif ($item->customTranslate($this->defaultLanguage->code) && isset(json_decode($item->customTranslate($this->defaultLanguage->code)->meta,true)[$type])) {
                $translate = json_decode($item->customTranslate($this->defaultLanguage->code)->meta,true)[$type];
                return $translate;
            }
        } else {
            if (isset($item->currentTranslate()->$type)) {
                return $item->currentTranslate()->$type;
            } elseif (isset($item->customTranslate($this->defaultLanguage->code)->$type)) {
                $translate = $item->customTranslate($this->defaultLanguage->code)->$type;
                return $translate;
            }
        }
    }
    
    public function getMeta($item,$type) {
        if (isset($item->currentTranslate()->$type)) {
                return $item->currentTranslate()->$type;
            }elseif($item->customTranslate($this->defaultLanguage->code)->$type){
               return $item->customTranslate($this->defaultLanguage->code)->$type;
            }else{
                return '';
            }
    }
   

}
