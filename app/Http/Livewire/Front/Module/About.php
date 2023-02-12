<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;
use Illuminate\Support\Facades\URL;

class About extends Component {

    use Module;

    public $multiLanguage,$lang;

    public function mount($lang) {
        $this->lang = app()->getLocale();
        $this->multiLanguage = $lang;
    }

    public function render() {
        $url = URL::to('/');
        $module = $this->getInterface()->firstByType('about');
        return view('livewire.front.module.about', compact('module', 'url'));
    }

}
