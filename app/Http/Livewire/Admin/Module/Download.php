<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use App\Traits\Admin\UpdateModule;

class Download extends Component {

    use UpdateModule;

    public $module_id, $uploadImage, $image, $content, $short_content, $title, $languages;
    public $is_module = false;
    public $typePage = 'download module';
    public $Translateparams = ['title', 'short_content', 'content'];
    public $IndexRoute = 'admin.modules';
    public $gate = 'design';
    protected $rules = [
        "short_content" => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "content" => "required|array|min:1",
        "content.en" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];

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
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
            $this->image = $data->file1;
        }
    }

    public function render() {
        return view('livewire.admin.module.download')->layout('layouts.admin');
    }

}
