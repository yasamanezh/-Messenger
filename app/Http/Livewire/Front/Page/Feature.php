<?php

namespace App\Http\Livewire\Front\Page;

use App\Repositories\Contract\IModuleOption;
use Livewire\Component;
use App\Traits\{
    Page,
    Translate

};
use App\Repositories\Contract\{

    IModule
 
};

class Feature extends Component {

    use Page;
    use Translate;

    public $page, $title;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage('feature');

        
    }
     public function getInterface() {

        return app()->make(IModule::class);
    }

    public function render() {
        $keyas1 = app()->make(IModuleOption::class)->skipTake('feature',0,4);
        $keyas2 = app()->make(IModuleOption::class)->skipTake('feature',4,100);
        $module = $this->getInterface()->firstByType('feature');
        return view('livewire.front.page.feature', compact('keyas1','keyas2','module'))->layout('layouts.front');
    }

}
