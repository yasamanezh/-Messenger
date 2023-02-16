<?php

namespace App\Http\Livewire\Admin\Language\Def;


use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\General;
use App\Repositories\Contract\IPhrase;

class Index extends Component {

    use WithPagination;
    use General;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'language';
    public $typePage = 'phrases';
    
    public function mount() {
         if (!Gate::allows('show_language')) {
             abort(403); 
        } 
    }

    public function getInterface() {

        return app()->make(IPhrase::class);
    }
  

    public function render()
    {

        $phrases = $this->readyToLoad ? $this->getInterface()->getPhrase($this->search,$this->sortColumnName,$this->sortDirection,$this->count_data)
         : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.language.def.index', compact('deleteItem', 'phrases'))->layout('layouts.admin');
    }
}
