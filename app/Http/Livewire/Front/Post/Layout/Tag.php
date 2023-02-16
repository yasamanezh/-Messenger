<?php

namespace App\Http\Livewire\Front\Post\Layout;

use Livewire\Component;
use App\Traits\Translate;

class Tag extends Component
{
      use Translate;
    public $tags;
    public function mount($post) {
        
        $this->tags=explode(',',$this->getMeta($post,'meta_keyword'));

    }
    public function render()
    {
        return view('livewire.front.post.layout.tag');
    }
}
