<?php

namespace App\Http\Livewire\Admin\Module\Page\All;

use App\Repositories\Contract\{
    ILog,
    IPage
};

use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component {

    use WithFileUploads;

    public $page_id,$slug,$use_app_module, $status,$meta_keyword = [], $title = [], $meta_description = [],$description = [], $languages;
    public $typePage = 'page';
    protected $rules = [
        "description"        => "required|array|min:1",
        "description.en"     => "required|string",
        "title"              => "required|array|min:1",
        "title.en"           => "required|string|min:3",
        "meta_keyword.en"     => "nullable|string|min:3",
        "meta_description.en" => "nullable|string|min:3",
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
            $content='';

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';

            if ($this->meta_keyword && $this->meta_keyword[$lan->language->code]) {
                $meta_keyword = $this->meta_keyword[$lan->language->code];
            }
            if ($this->meta_description && $this->meta_description[$lan->language->code]) {
                $meta_description = $this->meta_description[$lan->language->code];
            }

            $translations[] = [
                'title' => $title,
                'content' => $content,
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
            'use_app_module' => $this->use_app_module,
        ];
    }

    public function saveInfo() {
     
        if (Gate::allows('edit_page')) {
            $this->validate();
             $this->validate([
                'slug' => ['required', 'string', Rule::unique('pages')->ignore($this->page_id)],
            ]);
            $translates = $this->getTranslate();
            $items = $this->getItems();

            $data = $this->getInterface()->update($this->page_id,$items, $translates);
 
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'create ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($this->page_id),
            ]);
            return (redirect(route('admin.pages')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function mount($id) {
      
        if (!Gate::allows('show_page')) {
            abort(403);
        }
        $this->page_id =$id;
        $data = $this->getInterface()->find($id);
        $this->slug = $data->slug;
        $this->use_app_module = $data->use_app_module;

        $this->languages = $this->getInterface()->getLanguage();

        foreach ($this->languages as $value) {

            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
            $this->meta_keyword[$value->language->code] = '';
            $this->meta_description[$value->language->code] = '';
            
            $code = $data->translate()->where('language_id', $value->language->id)->first();
            if ($code) {
                $this->title[$value->language->code] = $code->title;
                $this->description[$value->language->code] = $code->content;
                $this->meta_keyword[$value->language->code] = $code->meta_keyword;
                $this->meta_description[$value->language->code] = $code->meta_description;
            }
        }
    }

    public function getInterface() {

        return app()->make(IPage::class);
    }

    public function render() {
        return view('livewire.admin.module.page.all.edit')->layout('layouts.admin');
    }

}
