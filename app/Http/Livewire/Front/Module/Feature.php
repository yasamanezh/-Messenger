<?php

namespace App\Http\Livewire\Front\Module;

use App\Repositories\Contract\IModuleOption;
use Livewire\Component;
use App\Traits\Module;

class Feature extends Component {

    use Module;

    public $lang, $setting;
    public $multiLanguage;

    public function mount($setting) {
        $this->lang = app()->getLocale();
        $this->multiLanguage = $setting[0];
        $this->setting = $setting[1];
        $this->hasMeta = true;
    }

    public function getUrl($param) {
        if ($this->multiLanguage) {
            return $_SERVER['APP_URL'] . '/' . app()->getlocale() . $param;
        } else {
            return $_SERVER['APP_URL'] . $param;
        }
    }

    public function render() {
        $type = 'feature';
        $keyas1 = app()->make(IModuleOption::class)->skipTake($type, 0, 4);
        $keyas2 = app()->make(IModuleOption::class)->skipTake($type, 4, 4);
        $module = $this->getInterface()->firstByType('feature');

        return view('livewire.front.module.feature', compact('module', 'keyas1', 'keyas2'));
    }

}
