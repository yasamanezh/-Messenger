<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;
use Illuminate\Support\Facades\URL;

class About extends Component {

    use Module;

    public $multiLanguage,$lang,$setting;

    public function mount($setting) {
        $this->lang = app()->getLocale();
        $this->multiLanguage = $setting[0];
        $this->setting = $setting[1];
    
    }
   public function getUrl($param) {
        if($this->multiLanguage){
            return env('API_DOMAIN').'/'.app()->getlocale().$param;
        }else{
            return env('API_DOMAIN').$param;
        }
       
    }
    public function render() {
        $url = URL::to('/');
        $module = $this->getInterface()->firstByType('about');
        return view('livewire.front.module.about', compact('module', 'url'));
    }

}
