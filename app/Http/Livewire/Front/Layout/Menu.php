<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Models\Menu as MenuModels;
use App\Models\Setting;
use App\Models\Language;
use App\Http\Controllers\GoogleTranslate;

class Menu extends Component {

    public $defaultLanguage, $lang;

    public function haveChild($param) {
        $menus = MenuModels::where('parent', $param)->get();
        return $menus;
    }

    public function mount() {
        $setting = Setting::first();
        $this->lang = app()->getLocale();
        $this->defaultLanguage = Language::findOrFail($setting->daf_lang);
    }

    public function getTitle($menu) {
        if (isset($menu->currentTranslate()->title)) {
            return $menu->currentTranslate()->title;
        } elseif (isset($menu->customTranslate($this->defaultLanguage->code)->title)) {
            $title = $menu->customTranslate($this->defaultLanguage->code)->title;
            return GoogleTranslate::translate($this->defaultLanguage->code, $this->lang, $title);
        }
    }

    public function render() {
        $menus = MenuModels::where('parent', 0)->where('status',1)->get();
        return view('livewire.front.layout.menu', compact('menus'));
    }

}
