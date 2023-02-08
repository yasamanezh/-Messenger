<?php

namespace App\Http\Livewire\Front\Blog;
use App\Repositories\Contract\iBlog;
use App\Traits\Module;
use Livewire\Component;

class Category extends Component
{
     use Module;
     public $multiLanguage;
     public function mount($lang) {
         
        $this->multiLanguage = $lang;
         
     }
    
    public function render(iBlog $blog)
    {
        $categories = $blog->getEnables();
        return view('livewire.front.blog.category', compact('categories'));
    }
}
