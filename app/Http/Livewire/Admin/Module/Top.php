<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\Admin\UpdateModule;
use Image;

class Top extends Component {

    use WithFileUploads;
    use UpdateModule;

    public $module_id, $uploadImage, $upload, $image, $uploadFile, $content, $short_content, $title, $languages,$count_use;
    public $is_module = false;
    public $inputImage = [], $product_img = [], $j = 0;
    public $typePage = 'top page module';
    public $Translateparams = ['title', 'short_content', 'content',['meta' => "count_use"]];
    public $IndexRoute = 'admin.modules';
    public $gate = 'design';
    protected $rules = [
        "short_content" => "required",
        "short_content.en" => "required|string|min:3",
        "content" => "required",
        "content.en" => "required|string|min:3",
        "title" => "required",
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

    public function saveImage() {
        $images = [];
        if ($this->inputImage) {
            foreach ($this->inputImage as $key => $value) {
                if (isset($this->uploadImage[$key])) {
                    $directory = "public/photos/modules/screen";
                    $name1 = $this->uploadImage[$key]->getClientOriginalName();
                    Image::make($this->uploadImage[$key]->getRealPath())->resize(300, 300)->save();
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

    public function uploadImage() {

        $directory = "public/photos/modules";
        $name = $this->upload->getClientOriginalName();
        Image::make($this->upload->getRealPath())->resize(950, 825)->save();
        $this->upload->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }

    public function uploadFile() {

        $directory = "public/photos/modules";
        $name = $this->uploadFile->getClientOriginalName();
        $this->uploadFile->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }

    public function getItems() {
        $data = [
            'type' => 'top_page',
        ];
        if ($this->upload) {
            $this->validate(['upload' => 'image']);
            $data['file1'] = $this->uploadImage();
        } elseif ($this->uploadFile) {

            $this->validate(['uploadFile' => 'file|mimes:zip']);
            $meta = ['file' => $this->uploadFile()];
            $data['meta'] = json_encode($meta);
        }
        return $data;
    }

    public function mount() {

        $data = $this->getInterface()->firstByType('top_page');
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
            $this->image = $data->file1;
        }
    }

    public function render() {
        return view('livewire.admin.module.top')->layout('layouts.admin');
    }

}
