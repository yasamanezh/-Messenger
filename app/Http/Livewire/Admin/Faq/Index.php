<?php

namespace App\Http\Livewire\Admin\Faq;


use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{IFaq,IHelp};
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\Settinges;


class Index extends Component
{
    use WithPagination;
    use Settinges;

    protected $queryString     = ['search'];
    protected $paginationTheme = 'bootstrap';

    public $typePage           = 'faq';
    public $gate = 'faq';
    public $editeroute = 'admin.faq.edit';
    
    public function mount() {
        if (!Gate::allows('show_faq')) {
            abort(403);
        }
    }

    public function getInterface() {

        return  app()->make(IFaq::class);

    }
    public function AllCategry() {

        return  app()->make(IHelp::class);

    }

    public function render(IFaq $faq) {

        $datas       = $this->readyToLoad ? $faq->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data) : [];
        $categories  = $this->AllCategry()->all('')->get();

        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.faq.index',compact('deleteItem','datas','categories'))->layout('layouts.admin');
    }
}
