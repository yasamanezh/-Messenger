<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Traits\Module;
use App\Repositories\Contract\IPost;

class Blog extends Component
{
    use Module;
    public $multiLanguage;
    public function mount($lang) {
        $this->multiLanguage = $lang;
    }
    public function render()
    {
        $module = $this->getInterface()->firstByType('blog');
        $blogs = app()->make(IPost::class)->takeByEnable(3);
     
        
        return view('livewire.front.module.blog', compact('module','blogs'));
        
    }
}
