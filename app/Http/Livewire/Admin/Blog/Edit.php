<?php

namespace App\Http\Livewire\Admin\Blog;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\iBlog;
use Illuminate\Validation\Rule;
use App\Repositories\Contract\ILog;

class Edit extends Component {

    public $blog_id, $slug, $status, $title, $meta_keyword, $meta_title, $meta_description, $languages;
    public $typePage = 'Blog Category';
    protected $rules = [
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

    public function getCurrentTitle() {

        return $this->getInterface()->getCurrentTitle($this->blog_id);
    }

    public function getItems() {
        return [
            'slug' => $this->slug,
            'status' => $this->status,
        ];
    }

    public function mount($id) {
        if (!Gate::allows('show_blog')) {
            abort(403);
        }

        $data = $this->getInterface()->find($id);
        $this->languages = $this->getInterface()->getLanguage();
        $this->status = $data->status;
        $this->blog_id = $id;
        $this->slug = $data->slug;

        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
            $this->meta_title[$value->language->code] = '';
            $this->meta_keyword[$value->language->code] = '';
            $this->meta_description[$value->language->code] = '';
            $code = $data->translate()->where('language_id', $value->language->id)->first();
            if ($code) {
                $this->title[$value->language->code] = $code->title;
                $this->meta_title[$value->language->code] = $code->meta_title;
                $this->meta_keyword[$value->language->code] = $code->meta_keyword;
                $this->meta_description[$value->language->code] = $code->meta_description;
            }
        }
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

    public function saveInfo() {
        if (Gate::allows('edit_blog')) {
            $this->validate();
            $this->validate([
                'slug' => ['required', 'string', Rule::unique('blogs')->ignore($this->blog_id)],
            ]);
            $translates = $this->getTranslate();
            $items = $this->getItems();
            $this->getInterface()->update($this->blog_id, $items, $translates);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($this->blog_id),
            ]);

            return (redirect(route('admin.blogs')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function getInterface() {

        return app()->make(iBlog::class);
    }

    public function render() {
        return view('livewire.admin.blog.edit')->layout('layouts.admin');
    }

}
