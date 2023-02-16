<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};
use App\Repositories\Contract\{

    IOption,IPack,ISetting
 
};

class Pack extends Component
{
      use Page;
    use Translate;

    public $page, $title;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage('pack');
        if(!$this->page){
            abort(404);
        }
        $this->seo($this->page );
     }

    public function render()
    {      $setting = app()->make(ISetting::class)->first();
         $module = $this->getInterface()->firstByType('pack');
         $packs  = app()->make(IPack::class)->getPacks();

        return view('livewire.front.page.pack', compact('module','packs','setting'))->layout('layouts.front');
    }
}
