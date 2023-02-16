<?php

namespace App\Http\Livewire\Front\Blog;

use Livewire\Component;
use App\Traits\Translate;

class Tag extends Component
{
    use Translate;
    public $tags;
    public function mount($blog) {

       
        $this->tags=explode(',',$this->getMeta($blog,'meta_keyword'));

    }
    public function render()
    {
        return view('livewire.front.blog.tag');
    }
}
