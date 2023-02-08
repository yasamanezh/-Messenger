<?php

namespace App\Http\Livewire\Admin\Module\Work;

use Livewire\Component;
use App\Repositories\Contract\{
    IModuleOption,
    ILog
};
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;

class Edit extends Component {

    use WithFileUploads;

    public $module_id, $short_content, $description, $uploadImage, $title, $sort, $image, $languages;
    public $typePage = 'How to work';
    protected $rules = [
        "sort" => "required|integer",
        "short_content" => "nullable",
        "short_content.en" => "nullable|string|min:3",
        "description" => "nullable",
        "description.en" => "nullable|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];

    public function uploadImage() {

        $directory = "public/photos/modules";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }

    public function getItems() {
        if ($this->uploadImage) {
            return [
                'type' => 'How_to_work',
                'sort' => $this->sort,
                'image' => $this->uploadImage(),
                'status' => 1
            ];
        } else {
            return [
                'type' => 'How_to_work',
                'sort' => $this->sort,
                'image' => $this->image,
                'status' => 1
            ];
        }
    }

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {
            $title = '';
            $content = '';
            $short_description = '';

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';
            $this->short_content[$lan->language->code] ? $short_description = $this->short_content[$lan->language->code] : $short_description = '';



            $translations[] = [
                'title' => $title,
                'content' => $content,
                '$short_description' => $short_description,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function saveInfo() {

        if (Gate::allows('edit_design')) {
            $this->validate();
            $translates = $this->getTranslate();
            $items = $this->getItems();

            $data = $this->getInterface()->update($this->module_id,$items, $translates);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'create ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($this->module_id),
            ]);
            return (redirect(route('admin.works')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function mount($id) {
        if (!Gate::allows('show_design')) {
            abort(403);
        }
        $data = $this->getInterface()->find($id);
        $this->languages = $this->getInterface()->getLanguage();

        foreach ($this->languages as $value) {

            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
            $this->short_content[$value->language->code] = '';
        }
        if ($data) {

            $this->sort = $data->sort;
            $this->image = $data->image;
            $this->status = $data->status;
            $this->module_id = $data->id;
            foreach ($this->languages as $value) {
                $code = $data->translate()->where('language_id', $value->language->id)->first();
                if ($code) {
                    $this->title[$value->language->code] = $code->title;
                    $this->description[$value->language->code] = $code->content;
                    $this->short_content[$value->language->code] = $code->short_content;
                }
            }
        }

        
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render() {

        return view('livewire.admin.module.work.edit')->layout('layouts.admin');
    }

}
