<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use App\Traits\Admin\UpdateModule;
use App\Repositories\Contract\{
    ILog
};

class About extends Component {

    use UpdateModule;


    public $module_id, $content, $uploadImage, $image, $short_content, $title, $more_text = [], $more_link, $languages;
    public $is_module       = false;
    public $typePage        = 'about module';
    public $Translateparams = ['title', 'short_content', 'content', ['meta' => "more_text"]];
    public $IndexRoute      = 'admin.modules';
    public $gate            = 'design';
    
    protected $rules = [
        "short_content"    => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "content"          => "required|array|min:1",
        "content.en"       => "required|string|min:3",
        "title"            => "required|array|min:1",
        "title.en"         => "required|string|min:3",
        "more_link"        => "nullable|string|min:2",
        "more_text"        => "nullable",
    ];

    

    public function getItems() {
        if ($this->uploadImage) {
            if ($this->uploadImage) {
                $this->validate([
                    'uploadImage' => 'required|image',
                    'type' => 'about',
                    'more_link' => $this->more_link,
                ]);
            }
            return [
                'file1' => $this->uploadImage(),
                'type' => 'about',
                'more_link' => $this->more_link,
            ];
        } else {
            return [
                'type' => 'about',
                'more_link' => $this->more_link,
            ];
        }
    }

    public function mount() {
        $data = $this->getInterface()->firstByType('about');
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
            $this->image = $data->file1;
            $this->more_link = $data->more_link;
        }
    }
    public function render() {
        return view('livewire.admin.module.about')->layout('layouts.admin');
    }

}
