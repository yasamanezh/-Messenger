<?php

namespace App\Http\Livewire\Front\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
use WithPagination;
    public $blog;
    public $multiLanguage =false;
      protected $paginationTheme = 'bootstrap';
    public function mount($language =null ,$id = null) {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->blog     = $id;
          }
    public function render()
    {
        return view('livewire.front.blog.blog')->layout('layouts.front');
    }
}
