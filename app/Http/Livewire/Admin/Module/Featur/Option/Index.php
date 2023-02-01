<?php

namespace App\Http\Livewire\Admin\Module\Featur\Option;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Traits\Admin\Settinges;

class Index extends Component
{
  
   use Settinges;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'design';
    public $typePage = 'feature keys';
    public $editeroute = 'admin.feature.option.edit';


    public function getInterface() {
        return  app()->make(IModuleOption::class);
    }
  
    public function render(IModuleOption $option) {

        $datas       = $option->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data);



        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.module.featur.option.index', compact('deleteItem','datas'))->layout('layouts.admin');
        }


}
