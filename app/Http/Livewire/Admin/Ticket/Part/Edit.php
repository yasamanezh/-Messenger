<?php

namespace App\Http\Livewire\Admin\Ticket\Part;

use Livewire\Component;
use App\Repositories\Contract\Ipart;
use App\Traits\Admin\UpdateSettinges;
use Illuminate\Support\Facades\Gate;

class Edit extends Component
{
    use UpdateSettinges;
    public $module_id, $status, $title, $languages;
    public $typePage  = 'ticket part';
    public $Translateparams  =['title'];
    public $IndexRoute       = 'admin.tickets.part';
    public $gate             ='ticket';
    protected $rules = [
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.en"            => "required|string|min:3",
    ];
     
    public function getItems() {
        return [
            'status' => $this->status,
        ];
        
    }
    
    public function mount($id) {
         if (!Gate::allows('show_ticket')) {
            abort(403);
        }
        $data            = $this->getInterface()->find($id);
        $this->languages = $this->getInterface()->getLanguage();
        $this->starterDate($data, $this->Translateparams);
        $this->status    = $data->status;
        $this->module_id   = $id;
    }
 
  
    public function getInterface() {

        return app()->make(Ipart::class);
    }

    public function render() {
        return view('livewire.admin.ticket.part.edit')->layout('layouts.admin');
    }
}
