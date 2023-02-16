<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};
use App\Repositories\Contract\{IHelp,IFaq};

class Faq extends Component {

    use Page;
    use Translate;

    public $page, $title;

    
    public function children($id) {
         return app()->make(IHelp::class)->childrenCategory($id);
    }
    public function mount($language = null,$id=null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage('faq');
        if(!$this->page){
            abort(404);
        }
        $this->seo($this->page );
  
 
    }
    
    public function faqs($id) {
        return app()->make(IFaq::class)->getFaqs($id);
    }

    public function render() {
        $parents = app()->make(IHelp::class)->parentsCategory();
        $allCategory = app()->make(IHelp::class)->allCategory();
        return view('livewire.front.page.faq', compact('parents','allCategory'))->layout('layouts.front');
    }

}
