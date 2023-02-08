<?php

namespace App\Http\Livewire\Front\Module;
use App\Repositories\Contract\IModuleOption;
use Livewire\Component;
use App\Traits\Module;

class Feature extends Component
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
        $keyas1 =   app()->make(IModuleOption::class)->skipTake($type,0,4);
        $keyas2 =   app()->make(IModuleOption::class)->skipTake($type,4,4);
        $module  = $this->getInterface()->firstByType('feature');
      
        return view('livewire.front.module.feature', compact('module','keyas1','keyas2'));
    }
}
