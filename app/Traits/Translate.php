<?php

namespace App\Traits;
use App\Repositories\Contract\ISetting;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\URL;

trait Translate {

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

    public function getMeta($item, $type) {

        if ($this->getCurrenTranslation($item, $type) != false) {
            return $this->getCurrenTranslation($item, $type);
        } else {
            return $this->getSettingTranslation($type);
        }
    }

    public function getCurrenTranslation($item, $type) {
        if ($item->currentTranslate() && isset($item->currentTranslate()->$type) && !empty($item->currentTranslate()->$type)) {
            return $item->currentTranslate()->$type;
        } elseif ($item->customTranslate('en')->$type && isset($item->customTranslate('en')->$type) && !empty($item->customTranslate('en')->$type)) {
            $translate = $item->customTranslate('en')->$type;
            return $translate;
        } else {
            return false;
        }
    }

    public function getSettingTranslation($type) {
        $item = app()->make(ISetting::class)->first();
        
            if ($item->currentTranslate() && isset($item->currentTranslate()->$type)) {
                return $item->currentTranslate()->$type;
            } elseif ($item->customTranslate('en')->$type && isset($item->customTranslate('en')->$type)) {
                $translate = $item->customTranslate('en')->$type;
                return $translate;
            } else {
                return '';
            }
        
    }
   public function seo($page) {
        
        $title = $this->getMeta($page,'title') ;
        $description = $this->getMeta($page,'meta_description');
        $keys = explode(',', $this->getMeta($page,'meta_keyword'));
        $options = \App\Models\Setting::first();
         $url=\Illuminate\Support\Facades\Request::url();
        $link = URL::to('/');
        $img = $link . '/storage/' . $options->logo;
        $lang = app()->getlocale();
        SEOTools::metatags();
        SEOTools::twitter();
        SEOTools::opengraph();
        SEOTools::jsonLd();
        SEOMeta::addKeyword($keys);
        SEOTools::setTitle($title);
        SEOTools::getTitle($session = false);
        SEOTools::setDescription($description);
        SEOTools::setCanonical($url);
        SEOTools::addImages($img);
        SEOMeta::addAlternateLanguage($lang, $url);
    }
}
