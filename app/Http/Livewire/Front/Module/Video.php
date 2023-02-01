<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Video extends Component
{
    use Module;
    
    public function render()
    {
         $module = $this->getInterface()->firstByType('video');
        return view('livewire.front.module.video', compact('module'))->layout('layouts.front');
    }
}
