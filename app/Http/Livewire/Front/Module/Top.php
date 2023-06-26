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
        $file = false;
        $module = $this->getInterface()->firstByType('top_page');
        if ($module->meta) {
            $file = json_decode($module->meta, true)['file'];
        }


        $images = $this->getInterface()->find($module->id)->attach;
        return view('livewire.front.module.top', compact('module', 'images', 'file'));
    }

}
