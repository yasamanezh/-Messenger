<?php

namespace App\Http\Livewire\Admin\Option;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\IOption;

use App\Traits\Admin\Settinges;

class Index extends Component {

    use WithPagination;
    use Settinges;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $typePage = 'package option';
    public $editeroute = 'admin.pack.option.edit';
    public $gate     = 'option';

    public function mount() {
        if (!Gate::allows('show_option')) {
            abort(403);
        }
    }

    public function getInterface() {

        return app()->make(IOption::class);
    }
    
  
    public function render(IOption $option) {

        $datas = $this->readyToLoad ? $option->all($this->search)
                        ->orderBy($this->sortColumnName, $this->sortDirection)
                        ->paginate($this->count_data) : [];

        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.option.index', compact('deleteItem', 'datas'))->layout('layouts.admin');
    }

}
