<?php

namespace App\Http\Livewire\Admin\Module\Customer;

use Livewire\Component;
use App\Traits\Admin\UpdateModule;

class Index extends Component
{
    use UpdateModule;
    public $module_id ,$short_content, $title,$languages;
    public $is_module =false;
    public $typePage  = 'client module';
    public $Translateparams = ['title', 'short_content'];
    public $IndexRoute      = 'admin.modules';
    public $gate            = 'design';
    

   protected $rules = [
        "short_content"    => "required|array|min:1",
        "short_content.en"  => "required|string|min:3", 
        "title"             => "required|array|min:1",
        "title.en"           => "required|string|min:3",      
    ];
    

     public function getItems() {
         return [  'type'  => 'client', ];   
    }
    
    public function mount() {        
        $data  = $this->getInterface()->firstByType('client');
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;

        }
    }

    public function render()
    {
        return view('livewire.admin.module.customer.index')->layout('layouts.admin');
    }
}
