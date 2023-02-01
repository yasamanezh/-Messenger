<?php

namespace App\Http\Livewire\Admin\Module\Counter;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;

use App\Traits\Admin\CreateSettinges;


class Add extends Component {
    
    use CreateSettinges;
    public $short_content, $title,$sort,$icon,$languages;
    public $typePage         = 'Counter Module';
    public $Translateparams  =['title','short_content'];
    public $IndexRoute       = 'admin.module.counters';
    public $gate             ='design';

    protected $rules = [ 
        "sort"           => "required|integer",
        "icon"           => "required|string",
        "short_content"    => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "title"          => "required|array|min:1",
        "title.en"       => "required|string|min:3",
    ];
    
    public function getItems() {
        return [
            'type'   => 'counter',
            'sort'   => $this->sort,
            'image'   => $this->icon,
           ];   
    }
    
    public function mount() {
       
        
        $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render() {

        return view('livewire.admin.module.counter.add')->layout('layouts.admin');
    }

}
