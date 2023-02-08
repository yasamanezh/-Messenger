<?php

namespace App\Http\Livewire\Front\Module;

use App\Repositories\Contract\IModuleOption;
use Livewire\Component;
use App\Traits\Module;

class Customer extends Component
{
    use Module;
    
    public function render()
    { 
        $module = $this->getInterface()->firstByType('client');
        $users =   app()->make(IModuleOption::class)->getByType('client',true);
 
        return view('livewire.front.module.customer', compact('module','users'));
    }
}
