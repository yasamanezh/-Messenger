<?php

namespace App\Traits;

use App\Repositories\Contract\{
    ISetting,
    IModule,
    IModuleOption
};
use App\Models\Language;

trait Module {

    public $defaultLanguage;
    public $hasMeta = false;

    public function getTranslate($type, $item, $metaType = null) {
        if ($metaType) {
            if ($item->currentTranslate() && isset(json_decode($item->currentTranslate()->meta, true)[$type])) {
                return json_decode($item->currentTranslate()->meta, true)[$type];
            } elseif ($item->customTranslate('en') && isset(json_decode($item->customTranslate('en')->meta, true)[$type])) {
                $translate = json_decode($item->customTranslate('en')->meta, true)[$type];
                return $translate;
            }
        } else {
            if (isset($item->currentTranslate()->$type)) {
                return $item->currentTranslate()->$type;
            } elseif (isset($item->customTranslate('en')->$type)) {
                $translate = $item->customTranslate('en')->$type;
                return $translate;
            }
        }
    }

  
    
    
    

    public function __construct() {
        $setting = app()->make(ISetting::class)->first();
        $this->lang = app()->getLocale();

        $this->defaultLanguage = Language::findOrFail($setting->daf_lang);
    }

    public function getInterface() {

        return app()->make(IModule::class);
    }

    public function getOptionInterface($type) {

        return app()->make(IModuleOption::class)->getByType($type, true);
    }

}
