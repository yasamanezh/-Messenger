<?php

namespace App\Http\Livewire\Admin\Package;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\Settinges;
use App\Repositories\Contract\{IOption,IPack};


class Index extends Component
{
   use WithPagination;
   use Settinges;

   protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'pack';
    public $editeroute = 'admin.pack.edit';
    public $typePage = 'packages';
    

    public function mount() {
        if (!Gate::allows('show_pack')) {
            abort(403);
        }
    }
    public function getInterface() {

        return  app()->make(IPack::class);

    }
    
    public function AllCategry() {

        return  app()->make(IOption::class);

    }
    
    public function render(IPack $pack) {

        $datas       = $this->readyToLoad ? $pack->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data) : [];
        $categories  = $this->AllCategry()->all('')->get();

        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.package.index',compact('deleteItem','datas','categories'))->layout('layouts.admin');
    }
}
