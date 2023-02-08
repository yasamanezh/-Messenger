<?php

namespace App\Http\Livewire\Front\Blog;
use App\Repositories\Contract\iBlog;
use Livewire\Component;
use App\Traits\Module;

class Post extends Component
{
    use Module;
      public $multiLanguage;
     public function mount($lang) {
         
        $this->multiLanguage = $lang;
         
     }
     
    public function render(iBlog $post)
    {
        $posts = $post->activePostsGet();
        return view('livewire.front.blog.post', compact('posts'));
    }
}
