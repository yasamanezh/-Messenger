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

    public $page, $title,$html,$css;

  
    public function mount($language = null,$id=null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage($id);
          if(!$this->multiLanguage){
              if($this->page->page_dat){
                $this->html=json_decode($this->page->page_data,true)['gjs-html'];
              $this->css=json_decode($this->page->page_data,true)['gjs-css'];
              }else{
                  $this->html=$this->getTranslate('content',$this->page);
                  $this->css=$this->getTranslate('short_content',$this->page);
              }
             
          }else{
              $this->html=$this->getTranslate('content',$this->page);
              $this->css=$this->getTranslate('short_content',$this->page);
              
          }
        

        $this->seo($this->page );
        if(!$this->page){
            abort(404);
        }
    }
    
  
    public function render() {

        return view('livewire.front.page.index')->layout('layouts.front');
    }

}
