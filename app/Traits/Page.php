<?php

namespace App\Traits;

use App\Repositories\Contract\{
    ISetting,
    IModule,
    IPage
};

use App\Models\Language;

trait Page {

    public $defaultLanguage;
    public $hasMeta = false;
    public $page;
    public $multiLanguage = false;
    



    public function __construct() {
        $setting = app()->make(ISetting::class)->first();
        $this->lang = app()->getLocale();

        $this->defaultLanguage = Language::findOrFail($setting->daf_lang);
    }

    public function getPageInterface() {

        return app()->make(IPage::class);
    }
    
    public function getPage($param) {
        
        return $this->getPageInterface()->findBySlug($param);
    }
    public function getInterface() {

        return app()->make(IModule::class);
    }

}
