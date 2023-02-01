<?php

namespace App\Http\Livewire\Admin\Module\Featur\Option;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Traits\Admin\UpdateSettinges;


class Edit extends Component {
    use UpdateSettinges;

    public $short_content, $title,$sort,$icon,$languages,$module_id;
    public $typePage  = 'Feature keys ';
    public $Translateparams  =['title','short_content'];
    public $IndexRoute       = 'admin.feature.options';
    public $gate             ='design';
    

   protected $rules = [ 
        "sort"           => "required|integer",
        "icon"           => "required|string",
        "short_content"    => "required|array|min:1",
        "short_content.en"  => "required|string|min:3",
        "title"          => "required|array|min:1",
        "title.en"        => "required|string|min:3",
    ];
    
  
     public function getItems() {
        return [
            'type'   => 'feature',
            'sort'   => $this->sort,
            'image'   => $this->icon,
           ];   
    }
    
    public function mount($id) {
        
        $data            = $this->getInterface()->find($id);
       $this->starterDate($data, $this->Translateparams);
        if($data){
            $this->module_id   = $id;
            $this->sort        = $data->sort;
            $this->icon        = $data->image; 
        } 
     
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render() {

        return view('livewire.admin.module.featur.option.edit')->layout('layouts.admin');
    }

}
