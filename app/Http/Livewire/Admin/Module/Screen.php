<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use App\Traits\Admin\UpdateModule;
use Livewire\WithFileUploads;
use Image;

class Screen extends Component {

    use UpdateModule;
    use WithFileUploads;

    public $module_id, $short_content, $title, $languages;
    public $inputImage = [], $product_img = [], $uploadImage = [], $j = 0;
    public $is_module = false;
    public $typePage = 'screen module';
    public $Translateparams = ['title', 'short_content'];
    public $IndexRoute = 'admin.modules';
    public $gate = 'design';
    protected $rules = [
        "short_content" => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
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
                    Image::make($this->uploadImage[$key]->getRealPath())->resize(530, 1115)->save();
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
        $this->starterDate($data, $this->Translateparams);
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
        }
    }

    public function render() {
        return view('livewire.admin.module.screen')->layout('layouts.admin');
    }

}
