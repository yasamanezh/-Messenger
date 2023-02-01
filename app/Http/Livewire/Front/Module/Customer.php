<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Customer extends Component
{
    use Module;
    
    public function render()
    { 
        $module = $this->getInterface()->firstByType('client');
        return view('livewire.front.module.customer', compact('module'));
    }
}
