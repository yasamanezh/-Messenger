<?php

namespace App\Http\Livewire\Front\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\iBlog;
use App\Traits\Translate;


class Blog extends Component {

    use Translate;
    use WithPagination;

    public $blog;
    public $multiLanguage = false;
    protected $paginationTheme = 'bootstrap';

    public function mount($language = null, $id = null) {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        if ($id) {
            $blog = app()->make(iBlog::class)->findBySlug($id);
            
            
            if (!$blog) {
                abort(404);
            }
            $this->blog = $blog;
            $this->seo($blog);
            
        } else {
            $this->blog = $id;
            $options = \App\Models\Setting::first();
             $this->seo($options);
        }
    }
    
    public function render() {
        return view('livewire.front.blog.blog')->layout('layouts.front');
    }

}
