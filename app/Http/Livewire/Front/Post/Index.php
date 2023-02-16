<?php

namespace App\Http\Livewire\Front\Post;

use Livewire\Component;
use App\Traits\Translate;
use App\Repositories\Contract\IPost;

class Index extends Component {

    use Translate;

    public $blog, $post;
    public $multiLanguage = false;

    public function mount($language = null, $id = null) {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->post = app()->make(IPost::class)->findBySlug($id);
        if(!$this->post){
           abort(404);
       }
        $this->seo($this->post);
       
    }

    public function render() {
        return view('livewire.front.post.index')->layout('layouts.front');
    }

}
