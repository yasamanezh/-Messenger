<?php

namespace App\Http\Livewire\Front\Module;
use App\Repositories\Contract\IModuleOption;
use Livewire\Component;
use App\Traits\Module;

class Feature2 extends Component
{
    use Module;
    public $lang; 
    public function mount() {
        
        $this->lang = app()->getLocale();
        $this->hasMeta =true;
        
    }
    public function render()
    {
        $type ='feature';
        $keyas =   app()->make(IModuleOption::class)->skipTake($type,0,6);
        $module  = $this->getInterface()->firstByType('feature2');
      
        return view('livewire.front.module.feature2', compact('module','keyas'));
    }
}
