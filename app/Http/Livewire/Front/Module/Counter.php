<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Counter extends Component
{
    use Module;
    
    public function render()
    {
         $module = $this->getInterface()->firstByType('download');
        return view('livewire.front.module.counter');
    }
}
