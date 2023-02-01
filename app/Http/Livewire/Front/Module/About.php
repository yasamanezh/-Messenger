<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class About extends Component
{
    use Module;
    
    public function render()
    {
        $module = $this->getInterface()->firstByType('about');
        return view('livewire.front.module.about', compact('module'));
    }
}
