<?php

namespace App\Traits\Admin;

use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\ILog;
use Livewire\WithPagination;

trait General {

    use WithPagination;

    public $search;
    public $readyToLoad = false;
    public $count_data = 10;
    public $IdBeingRemoved = null;
    public $mulitiSelect = [];
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage = false;

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getInterface() {

        return app()->make(IRole::class);
    }

    public function UpdatedSelectPage($value) {
        $param = [$this->search, $this->count_data];
        $this->mulitiSelect = $this->getInterface()->UpdatedCustomeSelectPage($value, $param);
    }

    public function confirmRemoval($categoryId) {
        $this->IdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function confirmAllRemoval() {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll() {
        if (Gate::allows('delete_' . $this->gate)) {
            $this->getInterface()->deleteAll($this->mulitiSelect);
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'Mass deletion',
                'url' => $this->typePage,
            ]);
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
        if (Gate::allows('delete_' . $this->gate)) {
            $name = $this->getInterface()->find($this->IdBeingRemoved)->name;

            $this->getInterface()->delete($this->IdBeingRemoved);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'delete ' . $this->typePage,
                'url' => $name,
            ]);
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
    
    public function statusSetting($param) {
        $this->getInterface()->chanseStatus($param);
    }
    
    public function changeStatus($id) {
        if (Gate::allows('edit_'.$this->gate)) {
            $this->statusSetting($id);
            $this->emit('toast', 'success', 'success !');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

}
