<?php

namespace App\Http\Livewire\Front\Page\Layout;

use Livewire\Component;

class Title extends Component
{
    public $title;
    public function mount($title) {
        
        $this->title =$title;
    }
    public function render()
    {
        return view('livewire.front.page.layout.title');
    }
}
