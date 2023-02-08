<?php

namespace App\Http\Livewire\Front\Home;

use Livewire\Component;

class Index extends Component
{
    public $multiLanguage=false;
    public function mount($language = null) {
          $language ? $this->multiLanguage = true : $this->multiLanguage = false;
    }
    public function render()
    {
        
        return view('livewire.front.home.index')->layout('layouts.front');
    }
}
