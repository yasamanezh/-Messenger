<?php

namespace App\Http\Livewire\Front\Blog;

use Livewire\Component;
use App\Repositories\Contract\iBlog;
use Livewire\WithPagination;
use App\Traits\Module;

class Index extends Component {

    use WithPagination;
    use Module;

    public $blog;
    public $search;
    public $multiLanguage = false;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public function mount($blog) {
        $blog[0] ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->blog =$blog[1];
      
    }

    public function render(iBlog $post) {

        $posts = $post->activePosts($this->search, $this->blog,3);
        return view('livewire.front.blog.index', compact('posts'))->layout('layouts.front');
    }

}
