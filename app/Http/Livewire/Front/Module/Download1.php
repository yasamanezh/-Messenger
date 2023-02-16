<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;
use App\Repositories\Contract\ISetting;

class Download1 extends Component
{
    use Module;
    
    public function render()
    {
         $setting = app()->make(ISetting::class)->first();
         $module = $this->getInterface()->firstByType('download');
        return view('livewire.front.module.download1', compact('module','setting'));
    }
}
