<?php

namespace App\Http\Livewire\Front\Post;

use Livewire\Component;
use App\Traits\Module;
use App\Repositories\Contract\IPost;

class Index extends Component {

    use Module;

    public $blog, $post;
    public $multiLanguage = false;

    public function mount($language = null, $id = null) {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->post = app()->make(IPost::class)->findBySlug($id);
       if(!$this->post){
           abort(404);
       }
    }

    public function render() {
        return view('livewire.front.post.index')->layout('layouts.front');
    }

}
