<?php

namespace App\Http\Livewire\Admin\Menu;


use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{IMenu,ILog};
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\Settinges;

class Index extends Component
{
    use Settinges;
    use WithPagination;

    protected $queryString     = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'design';
    public $editeroute = 'admin.menu.edit';
    public $typePage           = 'menus';


    public function getInterface() {

        return  app()->make(IMenu::class);

    }
    
        public function mount() {
         if (!Gate::allows('show_design')) {
             abort(403); 
        } 
    }

    public function render(IMenu $menu) {

        $datas       = $this->readyToLoad ? $menu->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data) : [];

        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.menu.index',compact('deleteItem','datas'))->layout('layouts.admin');
    }
}
