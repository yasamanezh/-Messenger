<?php

namespace App\Http\Livewire\Admin\Option;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\UpdateSettinges;
use App\Repositories\Contract\IOption;

class Edit extends Component
{
    use UpdateSettinges;
    public $module_id,$sort, $status, $title, $languages;
       public $typePage = 'package option';
    public $Translateparams  =['title'];
    public $IndexRoute       = 'admin.pack.options';
    public $gate             ='option';
    
    protected $rules = [
        'status'             => 'required|integer|min:0|max:1',
        'sort'             => 'required|integer|min:1',
        "title"              => "required|array|min:1",
        "title.en"            => "required|string|min:3",

    ];
      
    public function getItems() {
        return [
            'sort'   => $this->sort,
            'status' => $this->status,
        ];
        
    }
    
    public function mount($id) {
        if (!Gate::allows('show_option')) {
            abort(403);
        }
        $data            = $this->getInterface()->find($id);
        $this->starterDate($data, $this->Translateparams);
        if($data){
           $this->status    = $data->status;
        $this->module_id   = $id;
        $this->sort      = $data->sort; 
        }
        
    }
 
    public function getInterface() {

        return app()->make(IOption::class);
    }

    public function render()
    {
        return view('livewire.admin.option.edit')->layout('layouts.admin');
    }
}
