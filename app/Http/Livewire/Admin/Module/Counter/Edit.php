<?php

namespace App\Http\Livewire\Admin\Module\Counter;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Traits\Admin\UpdateSettinges;

class Edit extends Component {

    use UpdateSettinges;

    public $short_content, $title, $sort, $icon, $languages, $module_id,$content;

    public $typePage         = 'Counter Module';
    public $Translateparams  =['title','short_content','content'];
    public $IndexRoute       = 'admin.module.counters';
    public $gate             ='design';
    
    protected $rules = [
        "sort" => "required|integer",
        "icon" => "required|string",
        "short_content" => "required|array|min:1",
        "short_content.en" => "required|integer",

        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];

    public function mount($id) {
        $data = $this->getInterface()->find($id);
        $this->starterDate($data, $this->Translateparams);
        if ($data) { 
            $this->module_id = $id;
            $this->sort = $data->sort;
            $this->icon = $data->image;
        }
       
    }

    public function getInterface() {
        
        return app()->make(IModuleOption::class);
    }

    public function getItems() {
    
        return [
            'type' => 'counter',
            'sort' => $this->sort,
            'image' => $this->icon,
        ];
    }

    public function render() {

        return view('livewire.admin.module.counter.edit')->layout('layouts.admin');
    }

}
