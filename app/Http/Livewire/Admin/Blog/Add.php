<?php

namespace App\Http\Livewire\Admin\Blog;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Repositories\Contract\iBlog;
use App\Traits\Admin\CreateSettinges;

class Add extends Component {
    use CreateSettinges;
    public $slug, $status, $title, $meta_keyword = [], $meta_title = [], $meta_description = [], $languages;
    public $typePage = 'Blog Category';
    public $Translateparams  =['title','meta_keyword','meta_title','meta_description'];
    public $IndexRoute       = 'admin.blogs';
    public $gate             ='blog';
    protected $rules = [
        'slug'               => 'required|string|min:2|max:199||unique:blogs,slug',
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.en"           => "required|string|min:2",
        "meta_keyword.en"     => "nullable|string|min:2",
        "meta_title.en"       => "nullable|string|min:2",
        "meta_description.en" => "nullable|string|min:2",
    ];

    public function getItems() {
        $now = now()->format('M Y');
        $value =[$now];
        return [
            'slug' => $this->slug,
            'status' => $this->status,
              'archive'=> json_encode($value)
        ];
    }

  
    public function mount() {
        if (!Gate::allows('show_blog')) {
            abort(403);
        }
        $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(iBlog::class);
    }

    public function render() {

        return view('livewire.admin.blog.add')->layout('layouts.admin');
    }

}
