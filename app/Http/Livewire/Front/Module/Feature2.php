<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Feature2 extends Component
{
    use Module; 
    
    public function render()
    {
        
        return view('livewire.front.module.feature2');
    }
}
