<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};
use App\Repositories\Contract\{

    IOption,IPack
 
};

class Pack extends Component
{
      use Page;
    use Translate;

    public $page, $title;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage('pack');
     }

    public function render()
    {
         $module = $this->getInterface()->firstByType('pack');
         $packs  = app()->make(IPack::class)->getPacks();

        return view('livewire.front.page.pack', compact('module','packs'))->layout('layouts.front');
    }
}
