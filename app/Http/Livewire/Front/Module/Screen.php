<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Screen extends Component
{
    use Module;
    
    public function render()
    {
         $module = $this->getInterface()->firstByType('screen');
        return view('livewire.front.module.screen', compact('module'))->layout('layouts.front');
    }
}
