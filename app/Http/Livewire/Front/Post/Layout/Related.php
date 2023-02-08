<?php

namespace App\Http\Livewire\Front\Post\Layout;

use App\Repositories\Contract\IPost;
use Livewire\Component;
use App\Traits\Module;

class Related extends Component
{
    use Module;
      public $multiLanguage,$post,$related;
     public function mount($post) {
         
        $this->multiLanguage = $post[0];
        $this->post          = $post[1];
        $this->related       = explode(',', $this->post->related);
        
         
     }
     
    public function render(IPost $post)
    {
        $posts = $post->related($this->related); 
       
        return view('livewire.front.post.layout.related', compact('posts'));
    }
}
