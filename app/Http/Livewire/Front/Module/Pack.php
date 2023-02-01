<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Pack extends Component
{
    use Module;
    
    public function render()
    {
         $module = $this->getInterface()->firstByType('pack');
        return view('livewire.front.module.pack', compact('module'));
    }
}
