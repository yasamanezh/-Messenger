<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};

class About extends Component
{
    use Page;
    use Translate;

    public $page,$title;

    public function mount($language = null) {
        
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page     = $this->getPage('about');

       

    }
    public function render()
    {
        return view('livewire.front.page.about')->layout('layouts.front');
    }
}
