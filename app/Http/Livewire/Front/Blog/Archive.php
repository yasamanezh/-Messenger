<?php

namespace App\Http\Livewire\Front\Blog;

use Livewire\Component;

class Archive extends Component
{
    public $archives;
    public function mount($blog) {
      
         $this->archives = json_decode($blog->archives);  
    }
    public function render()
    {
  
        return view('livewire.front.blog.archive');
    }
}
