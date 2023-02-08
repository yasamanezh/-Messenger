<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Counter extends Component
{
    use Module;
    
    public function render()
    {
        $modules = $this->getOptionInterface('counter');
        return view('livewire.front.module.counter',compact('modules'));
    }
}
