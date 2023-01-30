<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Repositories\Contract\{
    ILog,
    IModule
};

class Download extends Component {

    use WithFileUploads;

    public $module_id, $uploadImage, $image, $description, $short_description, $title, $languages;
    public $is_module = false;
    public $typePage = 'download module';
    protected $rules = [
        "short_description" => "required|array|min:1",
        "short_description.*" => "required|string|min:3",
        "description" => "required|array|min:1",
        "description.*" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.*" => "required|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function uploadImage() {
        $directory = "public/photos/modules";
        $name = $this->uploadImage->getClientOriginalName();
        $this->uploadImage->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }

    public function getItems() {
        if ($this->uploadImage) {
            return [
                'file1' => $this->uploadImage(),
                'type' => 'download',
            ];
        } else {
            return [
                'type' => 'download',
            ];
        }
    }

    public function mount() {

        $data = $this->getInterface()->firstByType('download');

        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
            $this->short_description[$value->language->code] = '';
        }
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
            $this->image = $data->file1;
            foreach ($this->languages as $value) {
                $code = $data->translate()->where('language_id', $value->language->id)->first();
                if ($code) {
                    $this->title[$value->language->code] = $code->title;
                    $this->description[$value->language->code] = $code->content;
                    $this->short_description[$value->language->code] = $code->short_content;
                } 
            }
        }
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';
            $this->short_description[$lan->language->code] ? $shoret_content = $this->short_description[$lan->language->code] : $shoret_content = '';

            $translations[] = [
                'title' => $title,
                'content' => $content,
                'short_content' => $shoret_content,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function saveInfo() {

        $this->validate();
        if ($this->uploadImage) {
            $this->validate([
                'uploadImage' => 'required|image',
            ]);
        }
        $translates = $this->getTranslate();
        $items = $this->getItems();
        if ($this->is_module) {
            $this->getInterface()->update($this->module_id, $items, $translates);
        } else {
            $this->getInterface()->create($items, $translates);
        }

        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'edit ' . $this->typePage,
            'url' => $this->typePage,
        ]);


        return (redirect(route('admin.modules')))->with('sucsess', 'sucsess');
    }

    public function getInterface() {

        return app()->make(IModule::class);
    }

    public function render() {
        return view('livewire.admin.module.download')->layout('layouts.admin');
    }

}
