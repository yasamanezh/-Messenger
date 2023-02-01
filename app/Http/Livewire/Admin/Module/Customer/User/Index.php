<?php

namespace App\Http\Livewire\Admin\Module\Customer\User;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Traits\Admin\Settinges;

class Index extends Component
{
    use Settinges;

    protected $queryString     = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'design';
    public $editeroute = 'admin.customer.user.edit';
    public $typePage           = 'clients';


    public function getInterface() {

        return  app()->make(IModuleOption::class);

    }
    
    
    public function render(IModuleOption $option) {

        $datas       = $option->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data);


        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.module.customer.user.index', compact('deleteItem','datas'))->layout('layouts.admin');
    }
}
