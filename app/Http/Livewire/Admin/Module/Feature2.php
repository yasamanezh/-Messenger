<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use App\Repositories\Contract\{
    ILog,
    IModule
};
use App\Traits\Admin\UpdateModule;

class Feature2 extends Component {
    
     use UpdateModule;

    public $module_id, $short_content, $title, $languages;
    public $is_module = false;
    public $typePage = 'feature2 module';
    public $Translateparams = ['title', 'short_content'];
    public $IndexRoute = 'admin.modules';
    public $gate = 'design';
    protected $rules = [
        "short_content"    => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "title"            => "required|array|min:1",
        "title.en"          => "required|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getItems() {

        return [
            'type' => 'feature2',
        ];
    }

    public function mount() {

        $data = $this->getInterface()->firstByType('feature2');
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
        }

    }
    public function render() {
        return view('livewire.admin.module.feature2')->layout('layouts.admin');
    }

}
