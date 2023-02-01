<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\Admin\UpdateModule;

class Top extends Component {

    use WithFileUploads;
    use UpdateModule;

    public $module_id, $uploadImage, $image, $description, $short_description, $title, $languages;
    public $is_module = false;
    public $typePage = 'top page module';
    public $Translateparams = ['title', 'short_content','content'];
    public $IndexRoute = 'admin.modules';
    public $gate = 'design';
    protected $rules = [
        "short_content"   => "required",
        "short_content.en" => "required|string|min:3",
        "content"         => "required",
        "content.en"       => "required|string|min:3",
        "title"               => "required",
        "title.*"              => "required|string|min:3",
    ];

    public function getItems() {
        if ($this->uploadImage) {
            return [
                'file1' => $this->uploadImage(),
                'type' => 'top_page',
            ];
        } else {
            return [
                'type' => 'top_page',
            ];
        }
    }

    public function mount() {

        $data = $this->getInterface()->firstByType('top_page');
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
            $this->image = $data->file1;
        }
    }

    public function render() {
        return view('livewire.admin.module.top')->layout('layouts.admin');
    }

}
