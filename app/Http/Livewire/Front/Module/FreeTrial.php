<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;


class FreeTrial extends Component
{
    public $setting;
    public function mount() {
      
    }
    public function render()
    {
        return view('livewire.front.module.free-trial');
    }
}
