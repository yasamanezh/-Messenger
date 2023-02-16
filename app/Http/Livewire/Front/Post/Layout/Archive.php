<?php

namespace App\Http\Livewire\Front\Post\Layout;

use Livewire\Component;

class Archive extends Component
{
    public $archives;
    public function mount($post) {
         $this->archives = json_decode($post->archive);  
    }
    public function render()
    {
        return view('livewire.front.post.layout.archive');
    }
}
