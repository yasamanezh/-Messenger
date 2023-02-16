<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Video extends Component
{
    use Module;
       public $multiLanguage,$lang,$setting;

    public function mount($setting) {
        $this->lang = app()->getLocale();
        $this->multiLanguage = $setting[0];
        $this->setting = $setting[1];
    }
    public function render()
    {
         $module = $this->getInterface()->firstByType('video');
        return view('livewire.front.module.video', compact('module'))->layout('layouts.front');
    }
}
