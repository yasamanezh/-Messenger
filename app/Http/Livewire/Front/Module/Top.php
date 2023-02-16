<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Top extends Component {

    use Module;

    public $setting;

    public function mount($setting) {
        $this->setting = $setting;
    }

    public function render() {
        $module = $this->getInterface()->firstByType('top_page');

        return view('livewire.front.module.top', compact('module'));
    }

}
