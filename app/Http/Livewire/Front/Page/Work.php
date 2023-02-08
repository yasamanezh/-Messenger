<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};
use App\Repositories\Contract\{

    IModuleOption
 
};

class Work extends Component {

    use Page;
    use Translate;

    public $page, $title;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage('work');
        
    }

    public function render() {
        $steps =app()->make(IModuleOption::class)->getByType('How_to_work','true');
        return view('livewire.front.page.work', compact('steps'))->layout('layouts.front');
    }

}
