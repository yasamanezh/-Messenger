<?php

namespace App\Http\Livewire\Admin\Module\Page;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\{
    ILog,
    IPage
};

class About extends Component {

    public $module_id, $description, $meta_keyword, $title, $meta_description, $languages;
    public $typePage = 'About page';
    protected $rules = [
        "description" => "required|array|min:1",
        "description.en" => "required|string|min:3",
        "meta_keyword.en" => "nullable|string|min:3",
        "title.en" => "required|string|min:3",
        "meta_description.en" => "nullable|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getItems() {
        return [
            'slug' => 'about',
        ];
    }

    public $archive;

    public function mount() {
        $this->languages = $this->getInterface()->getLanguage();

        if (!Gate::allows('show_page')) {
            abort(403);
        }
        $data = $this->getInterface()->findBySlug('about');

        if ($data) {
            $this->module_id = $data->id;
        }

        foreach ($this->languages as $value) {
            $this->description[$value->language->code] = '';
            $this->title[$value->language->code] = '';
            $this->meta_keyword[$value->language->code] = '';
            $this->meta_description[$value->language->code] = '';
            if ($data) {
                $code = $data->translate()->where('language_id', $value->language->id)->first();
                if ($code) {
                    $this->description[$value->language->code] = $code->content;
                    $this->title[$value->language->code] = $code->title;
                    $this->meta_keyword[$value->language->code] = $code->meta_keyword;
                    $this->meta_description[$value->language->code] = $code->meta_description;
                }
            }
        }
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {
            $meta_title = '';
            $meta_keyword = '';
            $meta_description = '';
            $content = '';

            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';

            if ($this->title && $this->title[$lan->language->code]) {
                $meta_title = $this->title[$lan->language->code];
            }
            if ($this->meta_keyword && $this->meta_keyword[$lan->language->code]) {
                $meta_keyword = $this->meta_keyword[$lan->language->code];
            }
            if ($this->meta_description && $this->meta_description[$lan->language->code]) {
                $meta_description = $this->meta_description[$lan->language->code];
            }

            $translations[] = [
                'content' => $content,
                'title' => $meta_title,
                'meta_keyword' => $meta_keyword,
                'meta_description' => $meta_description,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function saveInfo() {

        if (Gate::allows('edit_page')) {
            $this->validate();

            $translates = $this->getTranslate();
            $items = $this->getItems();
            if ($this->module_id) {
                $this->getInterface()->update($this->module_id, $items, $translates);
            } else {
                $this->getInterface()->create($items, $translates);
            }
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit ' . $this->typePage,
                'url' => 'about page',
            ]);



            return (redirect(route('admin.pages')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function getInterface() {

        return app()->make(IPage::class);
    }

    public function render() {
 
        return view('livewire.admin.module.page.about')->layout('layouts.admin');
    }

}
