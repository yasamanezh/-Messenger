<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use App\Traits\Admin\UpdateModule;

class Pack extends Component
{
    use UpdateModule;
    public $module_id , $short_content, $title,$more_text =[],$more_link  ,$languages;
    public $is_module =false;
    public $typePage  = 'pack module';
    public $Translateparams = ['title', 'short_content', ['meta' => "more_text"]];
    public $IndexRoute = 'admin.modules';
    public $gate = 'design';

   protected $rules = [
        "short_content"    => "required|array|min:1",
        "short_content.en"  => "required|string|min:3", 
        "title"                => "required|array|min:1",
        "title.en"              => "required|string|min:3",      
        "more_link"             => "nullable|string",
       "more_text"             => "nullable|array|min:1",
        "more_text.en"          => "nullable|string|min:3",
    ];
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
       
     public function getItems() {
         
            return [
                'type'       => 'pack',
                'more_link'  => $this->more_link
            ];         
    }

    public function mount() {
        $data   = $this->getInterface()->firstByType('pack');
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
            $this->more_link = $data->more_link;
        }   
    }
 
    public function render()
    {
        return view('livewire.admin.module.pack')->layout('layouts.admin');
    }
}
