<?php

namespace App\Http\Livewire\Front\Module;

use App\Repositories\Contract\IModuleOption;
use Livewire\Component;
use App\Traits\Module;

class Feature2 extends Component {

    use Module;

    public $lang, $setting, $multiLanguage;

    public function mount($setting) {

        $this->lang = app()->getLocale();
        $this->multiLanguage = $setting[0];
        $this->setting = $setting[1];
        $this->hasMeta = true;
    }
 public function getUrl($param) {
        if($this->multiLanguage){
            return $_SERVER['APP_URL'].'/'.app()->getlocale().$param;
        }else{
            return $_SERVER['APP_URL'].$param;
        }
       
    }
    public function render() {
        $type = 'feature';
        $keyas = app()->make(IModuleOption::class)->skipTake($type, 8, 6);
        $module = $this->getInterface()->firstByType('feature2');


        return view('livewire.front.module.feature2', compact('module', 'keyas'));
    }

}
