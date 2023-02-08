<?php

namespace App\Http\Livewire\Front\Blog;

use Livewire\Component;
use App\Repositories\Contract\iBlog;
use App\Traits\Module;

class Tag extends Component
{
    use Module;
    public $tags;
    public function mount($blog) {
        
        $blog = app()->make(iBlog::class)->findBySlug($blog);
       
        $this->tags=explode(',',$this->getMeta($blog,'meta_keyword'));

    }
    public function render()
    {
        return view('livewire.front.blog.tag');
    }
}
