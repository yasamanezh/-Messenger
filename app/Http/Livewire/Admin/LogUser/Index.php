<?php

namespace App\Http\Livewire\Admin\LogUser;

use App\Repositories\Contract\ILog;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component {

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public $search;
    public $readyToLoad = false;
    public $SelectPage = false;
    public $mulitiSelect = [];
    public $count_data = 10;
    public $IdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public function getInterface() {

        return app()->make(ILog::class);
    }

    public function mount() {
        if (!Gate::allows('show_AdminLogs')) {
            abort(403);
        }
    }

    public function UpdatedSelectPage($value) {
        $param = ['url', $this->search, $this->count_data];
        $this->mulitiSelect = $this->getInterface()->UpdatedSelectPage($value, $param);
    }

    public function confirmRemoval($categoryId) {
        $this->IdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function confirmAllRemoval() {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll() {
        if (Gate::allows('delete_AdminLogs')) {
            $this->getInterface()->deleteAll($this->mulitiSelect);
            $this->mulitiSelect = [];
            $this->SelectPage = false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'success !');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function delete() {
        if (Gate::allows('delete_AdminLogs')) {
            $this->getInterface()->delete($this->IdBeingRemoved);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'success !');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function cancelDelete() {

        $this->dispatchBrowserEvent('hide-delete-modal');
    }

    public function cancellAllDelete() {

        $this->dispatchBrowserEvent('hide-form');
    }

    

    public function sortBy($columnName) {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection() {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function loadPage() {

        $this->readyToLoad = true;
    }

    public function render() {

        $data_info = $this->readyToLoad ? $this->getInterface()->all('url', $this->search)
                        ->orderBy($this->sortColumnName, $this->sortDirection)
                        ->latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.log.index', compact('data_info', 'deleteItem'))->layout('layouts.admin');
    }

}
