<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;
use Illuminate\Support\Facades\URL;

class About extends Component
{
    use Module;
    
    public function render()
    {
        $url = URL::to('/');
        $module = $this->getInterface()->firstByType('about');
        return view('livewire.front.module.about', compact('module','url'));
    }
}
