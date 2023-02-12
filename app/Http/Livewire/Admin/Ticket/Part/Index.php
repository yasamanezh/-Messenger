<?php

namespace App\Http\Livewire\Admin\Ticket\Part;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\Ipart;
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\Settinges;


class Index extends Component
{
    use WithPagination;
    use Settinges;

    protected $queryString     = ['search'];
    protected $paginationTheme = 'bootstrap';

    public $gate = 'ticket';
    public $editeroute = 'admin.ticket.part.edit';
    public $typePage           = 'parts';

     public function mount() {
         if (!Gate::allows('show_ticket')) {
             abort(403); 
        } 
    }

    public function getInterface() {

        return  app()->make(Ipart::class);

    }
  

    public function render(Ipart $part) {

        $datas       = $this->readyToLoad ? $part->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data) : [];

        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.ticket.part.index', compact('deleteItem','datas'))->layout('layouts.admin');
    }
}
