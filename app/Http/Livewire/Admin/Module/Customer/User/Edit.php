<?php

namespace App\Http\Livewire\Admin\Module\Customer\User;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Traits\Admin\UpdateSettinges;
use Livewire\WithFileUploads;

class Edit extends Component {
    use WithFileUploads;
    use UpdateSettinges;

    public $short_content, $title,$name =[],$job =[],$uploadImage,$sort,$image,$languages,$module_id;
    public $typePage         = 'clients ';
    public $Translateparams  = ['title', 'short_content',  ["name","job"]];
    public $IndexRoute       = 'admin.customer.users';
    public $gate             ='design';

     protected $rules = [
        "sort" => "required|integer",
        "short_content" => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3", 
        "name" => "required|array|min:1",
        "name.en" => "required|string|min:3",
    ];
    public function uploadImage(){
        $directory="public/photos/modules";
        $name=$this->uploadImage->getClientOriginalName();
        $this->uploadImage->storeAs($directory,$name);
        return("photos/modules/"."$name");
    }
    
    
     public function getItems() {
         
        if($this->uploadImage){
             return [
                'image'  => $this->uploadImage(),
                'type'   => 'client',
                'sort'   => $this->sort,

            ];
         } else {
            return [
                'type'   => 'client',
                'sort'   => $this->sort,
            ];
         }
    }
    
    public function mount($id) {
        
        $data = $this->getInterface()->find($id);
        $this->starterDate($data, $this->Translateparams);
        $this->languages = $this->getInterface()->getLanguage();
        if ($data) {
            $this->module_id = $id;
            $this->sort = $data->sort;
            $this->image = $data->image;
        }
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render()
    {
        return view('livewire.admin.module.customer.user.edit')->layout('layouts.admin');
    }
}
