<?php

namespace App\Http\Livewire\Front\Module;
use Livewire\Component;

use App\Traits\Module;

class Top extends Component {

    use Module;

    public function render() {
        $module = $this->getInterface()->firstByType('top_page');
        
        return view('livewire.front.module.top', compact('module'));
    }

}
