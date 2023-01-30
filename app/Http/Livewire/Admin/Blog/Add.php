<?php

namespace App\Http\Livewire\Admin\Blog;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Repositories\Contract\iBlog;
use App\Repositories\Contract\ILog;

class Add extends Component {

    public $slug, $status, $title, $meta_keyword = [], $meta_title = [], $meta_description = [], $languages;
    public $typePage = 'Blog Category';
    protected $rules = [
        'slug'               => 'required|string|min:2|max:199||unique:blogs,slug',
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.en"           => "required|string|min:3",
        "meta_keyword.*"     => "nullable|string|min:3",
        "meta_title.*"       => "nullable|string|min:3",
        "meta_description.*" => "nullable|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {
            $meta_title = '';
            $meta_keyword = '';
            $meta_description = '';

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';

            if ($this->meta_title && $this->meta_title[$lan->language->code]) {
                $meta_title = $this->meta_title[$lan->language->code];
            }
            if ($this->meta_keyword && $this->meta_keyword[$lan->language->code]) {
                $meta_keyword = $this->meta_keyword[$lan->language->code];
            }
            if ($this->meta_description && $this->meta_description[$lan->language->code]) {
                $meta_description = $this->meta_description[$lan->language->code];
            }

            $translations[] = [
                'title' => $title,
                'meta_title' => $meta_title,
                'meta_keyword' => $meta_keyword,
                'meta_description' => $meta_description,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function getItems() {
        return [
            'slug' => $this->slug,
            'status' => $this->status,
        ];
    }

    public function saveInfo() {
        if (Gate::allows('edit_blog')) {
            
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
        if (Gate::allows('edit_blog')) {
            $this->validate();
            $translates = $this->getTranslate();
            $items = $this->getItems();
            $data = $this->getInterface()->create($items, $translates);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'create ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($data),
            ]);
            return (redirect(route('admin.blogs')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function mount() {
        if (!Gate::allows('show_blog')) {
            abort(403);
        }
        $this->status = 1;
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {
            $this->title[$value->language->code]            = '';
            $this->meta_keyword[$value->language->code]     = '';
            $this->meta_title[$value->language->code]       = '';
            $this->meta_description[$value->language->code] = '';
        }
    }

    public function getInterface() {

        return app()->make(iBlog::class);
    }

    public function render() {

        return view('livewire.admin.blog.add')->layout('layouts.admin');
    }

}
