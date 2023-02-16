<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};

class Index extends Component {

    use Page;
    use Translate;

    public $page, $title;

  
    public function mount($language = null,$id=null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage($id);
        $this->seo($this->page );
        if(!$this->page){
            abort(404);
        }
  
 
    }
    
  
    public function render() {

        return view('livewire.front.page.index')->layout('layouts.front');
    }

}
