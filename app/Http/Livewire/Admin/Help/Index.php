<?php

namespace App\Http\Livewire\Admin\Help;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{
    ILog,
    IHelp
};
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\Settinges;

class Index extends Component {

    use WithPagination;
    use Settinges;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'faq';
    public $editeroute = 'admin.help.edit';
    public $typePage = 'faq category';

    public function mount() {
        if (!Gate::allows('show_faq')) {
            abort(403);
        }
    }

    public function getInterface() {

        return app()->make(IHelp::class);
    }


    public function render(IHelp $help) {

        $datas = $this->readyToLoad ? $help->all($this->search)
                        ->orderBy($this->sortColumnName, $this->sortDirection)
                        ->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.help.index', compact('deleteItem', 'datas'))->layout('layouts.admin');
    }

}
