<?php

namespace App\Http\Livewire\Front\Post\Layout;

use Livewire\Component;
use App\Traits\Module;

class Tag extends Component
{
      use Module;
    public $tags;
    public function mount($post) {
        
        $this->tags=explode(',',$this->getMeta($post,'meta_keyword'));

    }
    public function render()
    {
        return view('livewire.front.post.layout.tag');
    }
}
