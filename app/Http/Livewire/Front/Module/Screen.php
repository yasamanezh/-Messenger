<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Screen extends Component {

    use Module;

    public $lang;

    public function mount() {

        $this->lang = app()->getLocale();
        $this->hasMeta = true;
    }

    public function render() {
        $module = $this->getInterface()->firstByType('screenshot');
        $images = $this->getInterface()->find($module->id)->attach;

        return view('livewire.front.module.screen', compact('module','images'))->layout('layouts.front');
    }

}
