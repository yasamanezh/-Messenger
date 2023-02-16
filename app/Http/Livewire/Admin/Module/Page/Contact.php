<?php

namespace App\Http\Livewire\Admin\Module\Page;

use Livewire\Component;
use App\Traits\Admin\UpdateSettinges;
use App\Repositories\Contract\IPage;
use Illuminate\Support\Facades\Gate;

class Contact extends Component {

    use UpdateSettinges;

    public $module_id, $content, $short_content, $title, $call_text, $languages;
    public $meta_keyword = [], $meta_title = [], $meta_description = [];
    public $is_module = false;
    public $typePage = 'contact page';
    public $Translateparams = ['title', 'short_content', 'content', 'meta_keyword', 'meta_title', 'meta_description', ['meta' => "call_text"]];
    public $IndexRoute = 'admin.pages';
    public $gate = 'page';
    protected $rules = [
        "short_content" => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "content" => "nullable|array|min:1",
        "content.en" => "nullable|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
        "meta_keyword.en" => "nullable|string|min:2",
        "meta_title.en" => "nullable|string|min:2",
        "meta_description.en" => "nullable|string|min:2",
        "call_text" => "nullable",
    ];

    public function getInterface() {
        return app()->make(IPage::class);
    }

    public function getItems() {
        return ['slug' => 'contact'];
    }

    public function mount() {
         if (!Gate::allows('show_page')) {
             abort(403); 
        } 
        $data = $this->getInterface()->findBySlug('contact');
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
        }
    }

    public function render() {
        return view('livewire.admin.module.page.contact')->layout('layouts.admin');
    }

}
