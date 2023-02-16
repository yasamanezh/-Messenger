<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;

class Download extends Component
{
    use Module;
    public $setting;
    public function mount($setting) {
       
        $this->setting = $setting;
        
    }
    public function render()
    {
         $module = $this->getInterface()->firstByType('download');
        return view('livewire.front.module.download', compact('module'));
    }
}
