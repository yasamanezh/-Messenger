<?php

namespace App\Http\Livewire\Admin\Language;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\General;
use App\Repositories\Contract\{
    ITranslation,
    IPhrase
};

class Index extends Component {

    use WithPagination;
    use General;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'language';
    public $typePage = 'language';
    public $key, $value;

    public function mount() {
        if (!Gate::allows('show_language')) {
            abort(403);
        }
    }

    public function confirmCreate() {
        $this->dispatchBrowserEvent('show-form1');
    }

    public function canncelAdd() {
        $this->dispatchBrowserEvent('hide-form1');
    }

    public function saveInfo() {
        if (Gate::allows('edit_language')) {
            $this->validate([
            'value' => 'required|string',
            'key' => 'required|string',
        ]);
        $data = [
            'key' => $this->key,
            'value' => $this->value,
        ];
        app()->make(IPhrase::class)->create($data);

        $this->dispatchBrowserEvent('hide-form1');
        $this->reset('key', 'value');
        $this->emit('toast', 'success', 'success !');
        } else {
             $this->emit('toast', 'success', 'success !');
            $this->emit('toast', 'warning', 'permission denied !');
        }
        
    }

    public function getInterface() {

        return app()->make(ITranslation::class);
    }

    public function render() {

        $languages = $this->readyToLoad ? $this->getInterface()->getTranslation($this->search, $this->sortColumnName, $this->sortDirection, $this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.language.index', compact('deleteItem', 'languages'))->layout('layouts.admin');
    }

}
