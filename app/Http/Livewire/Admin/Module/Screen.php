<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use App\Repositories\Contract\{
    ILog,
    IModule
};
use Livewire\WithFileUploads;

class Screen extends Component {

    use WithFileUploads;

    public $module_id, $short_description, $title, $languages;
    public $inputImage = [], $product_img = [], $uploadImage = [], $j = 0;
    public $is_module = false;
    public $typePage = 'screen module';
    protected $rules = [
        "short_description" => "required|array|min:1",
        "short_description.*" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.*" => "required|string|min:3",
    ];

    public function AddImage($j) {

        $j = $j + 1;
        $this->j = $j;
        array_push($this->inputImage, $j);
    }

    public function removeImage($j) {
        unset($this->inputImage[$j]);
        if (isset($this->uploadImage[$j])) {
            unset($this->uploadImage[$j]);
        } else {
            unset($this->product_img[$j]);
        }
    }

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getItems() {
        return ['type' => 'screenshot',];
    }

    public function saveImage() {
        $images = [];
        if ($this->inputImage) {
            foreach ($this->inputImage as $key => $value) {
                if (isset($this->uploadImage[$key])) {
                    $directory = "public/photos/modules/screen";
                    $name1 = $this->uploadImage[$key]->getClientOriginalName();
                    $this->uploadImage[$key]->storeAs($directory, $name1);
                    $images[] = [
                        'file' => "photos/modules/screen/" . "$name1",
                    ];
                } elseif (isset($this->product_img[$key])) {
                    $images[] = [
                        'file' => $this->product_img[$key],
                    ];
                }
            }
        }


        return $images;
    }

    public function deleteOldImage() {
        $oldImage = $images = $this->getInterface()->find($this->module_id)->attach;

        foreach ($oldImage as $value) {

            $value->delete();
        }
    }

    public function mount() {

        $data = $this->getInterface()->firstByType('screenshot');
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
            $this->short_description[$value->language->code] = '';
        }



        if ($data) {
            $images = $this->getInterface()->find($data->id)->attach;
            if ($images) {
                foreach ($images as $image) {
                    $j = $this->j;
                    $j = $j + 1;
                    array_push($this->inputImage, $j);
                    array_push($this->product_img, $image->file);
                }
            }

            $this->is_module = true;
            $this->module_id = $data->id;

            foreach ($this->languages as $value) {
                $code = $data->translate()->where('language_id', $value->language->id)->first();
                if ($code) {
                    $meta = json_decode($code->meta, true);
                    $this->title[$value->language->code] = $code->title;
                    $this->short_description[$value->language->code] = $code->short_content;
                }
            }
        }
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->short_description[$lan->language->code] ? $shoret_content = $this->short_description[$lan->language->code] : $shoret_content = '';
            $translations[] = [
                'title' => $title,
                'short_content' => $shoret_content,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function saveInfo() {


        $this->validate();
        if ($this->inputImage) {
            foreach ($this->inputImage as $key => $value) {
                if (isset($this->uploadImage[$key])) {
                    $this->validate([
                        "uploadImage.$key" => 'nullable|image|mimes:jpg,bmp,png,jpeg,gif,webp,svg',
                            ], [
                        'uploadImage.*.image' => 'image field must be a image.',
                        'uploadImage.*.mimes' => 'the mime type of image is jpg,bmp,png,jpeg,gif,webp,svg . ',
                    ]);
                }
            }
        }
        $translates = $this->getTranslate();
        $items = $this->getItems();

        if ($this->is_module) {
            $this->getInterface()->update($this->module_id, $items, $translates);
            $this->deleteOldImage();
            $this->getInterface()->updateImage($this->module_id, $this->saveImage());
        } else {
            $id = $this->getInterface()->create($items, $translates);
            $this->getInterface()->updateImage($id, $this->saveImage());
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
        return view('livewire.admin.module.screen')->layout('layouts.admin');
    }

}
