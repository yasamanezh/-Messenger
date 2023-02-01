<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Blog extends Component
{
    use Module;
    
    public function render()
    {
        $module = $this->getInterface()->firstByType('blog');
        return view('livewire.front.module.blog', compact('module'));
        
    }
}
