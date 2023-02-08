<?php

namespace App\Http\Livewire\Front\Blog;

use App\Repositories\Contract\iBlog;
use Livewire\Component;

class Archive extends Component
{
    public $archives;
    public function mount($blog) {
        $currentBlog = app()->make(iBlog::class)->findBySlug($blog);
         $this->archives = json_decode($currentBlog->archive);  
    }
    public function render()
    {
  
        return view('livewire.front.blog.archive');
    }
}
