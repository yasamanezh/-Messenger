<?php

namespace App\Http\Livewire\Admin\Module\Featur;

use Livewire\Component;
use App\Traits\Admin\UpdateModule;

class Index extends Component
{
    use UpdateModule;
    public $module_id ,$content, $short_content, $title,$more_text =[],$more_link  ,$languages;
    public $is_module =false;
    public $typePage  = 'feature module';
    public $Translateparams = ['title', 'short_content', 'content', ['meta' => "more_text"]];
    public $IndexRoute      = 'admin.modules';
    public $gate            = 'design';

   protected $rules = [
        "short_content"     => "required|array|min:1",
        "short_content.en"  => "required|string|min:3", 
        "content"           => "required|array|min:1",
        "content.en"        => "required|string|min:3",
        "title"             => "required|array|min:1",
        "title.en"          => "required|string|min:3",      
        "more_link"         => "nullable|string|min:2",

    ];
    
   
       
     public function getItems() {
         return [  'type'  => 'feature','more_link' => $this->more_link, ];   
    }
    
    public function mount() {
        $data = $this->getInterface()->firstByType('feature');
        $this->starterDate($data, $this->Translateparams);
        
        if($data){
            $this->is_module   = true;
            $this->module_id   = $data->id;
            $this->more_link   = $data->more_link;
        } 
    }

    public function render()
    {
        return view('livewire.admin.module.featur.index')->layout('layouts.admin');
    }
}
