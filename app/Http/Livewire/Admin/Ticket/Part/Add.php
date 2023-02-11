<?php

namespace App\Http\Livewire\Admin\Ticket\Part;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\Ipart;
use App\Traits\Admin\CreateSettinges;

class Add extends Component
{
    use CreateSettinges;
      public  $status, $title, $languages;
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

   
    public function mount() {
        $this->status    = 1;
         if (!Gate::allows('show_ticket')) {
            abort(403);
        }
        $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(Ipart::class);
    }

    public function render() {

        return view('livewire.admin.ticket.part.add')->layout('layouts.admin');;
    }
}
