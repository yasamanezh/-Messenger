<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Repositories\Contract\{IPack,IOption};
use App\Traits\Module;

class Pack extends Component
{
    use Module;
    
    public function render()
    {
        $module = $this->getInterface()->firstByType('pack');
         $modules = app()->make(IOption::class)->getEnables();
         $packs  = app()->make(IPack::class)->takeByEnable(2);
        
        return view('livewire.front.module.pack', compact('modules','packs','module'));
    }
}
