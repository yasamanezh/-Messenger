<?php

namespace App\Http\Livewire\Admin\Module\Featur\Option;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Traits\Admin\CreateSettinges;

class Add extends Component {
    
    use CreateSettinges;

    public $short_content, $title, $sort, $icon, $languages;
    public $typePage = 'Feature Keys ';
    public $Translateparams = ['title', 'short_content'];
    public $IndexRoute = 'admin.feature.options';
    public $gate = 'design';
    
    protected $rules = [
        "sort" => "required|integer",
        "icon" => "required|string",
        "short_content" => "nullable",
        "short_content.en" => "nullable|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];

    public function getItems() {
        return [
            'type' => 'feature',
            'sort' => $this->sort,
            'image' => $this->icon,
            'status'=>1
        ];
    }

    public function mount() {

         $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render() {

        return view('livewire.admin.module.featur.option.add')->layout('layouts.admin');
    }

}
