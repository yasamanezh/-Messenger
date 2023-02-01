<?php

namespace App\Traits\Admin;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\ILog;
use Livewire\WithPagination;

trait Settinges {
    use WithPagination;
    public $search;
    public $readyToLoad        = false;
    public $count_data         = 10;
    public $IdBeingRemoved     = null;
    public $mulitiSelect       = [];
    public $sortColumnName     = 'created_at';
    public $sortDirection      = 'desc';
    public $SelectPage         = false;

    public function cancelDelete() {

        $this->dispatchBrowserEvent('hide-delete-modal');
    }

    public function cancellAllDelete() {

        $this->dispatchBrowserEvent('hide-form');
    }
    
    public function confirmRemoval($categoryId)  {
        $this->IdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllRemoval() {
        $this->dispatchBrowserEvent('show-form');
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
    
    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getCurrentTitle($id) {

        return $this->getInterface()->getCurrentTitle($id);
    }

    public function UpdatedSelectPage($value) {
        $param = [$this->search, $this->count_data];
        $this->mulitiSelect = $this->getInterface()->UpdatedSelectPage($value, $param);
    }
    
    public function deleteAllSetting() {
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
    }
    
    public function deleteSetting() {
        $title = $this->getCurrentTitle($this->IdBeingRemoved);
        $this->getInterface()->delete($this->IdBeingRemoved);
        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'delete ' . $this->typePage,
            'url' => $title,
        ]);
        $this->dispatchBrowserEvent('hide-delete-modal');
        $this->emit('toast', 'success', 'success !');
    }
    
    public function statusSetting($id) {
        $this->getInterface()->chanseStatus($id);
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'change Status ' . $this->typePage,
                'url' => $this->getCurrentTitle($id),
            ]);
            $this->emit('toast', 'success', 'success !');
        
    }
    
     public function deleteAll() {
        if (Gate::allows('delete'.$this->gate)) {
            $this->deleteAllSetting();
            $this->dispatchBrowserEvent('hide-form');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function delete() {
        
        if (Gate::allows('delete_'.$this->gate)) {
             $this->deleteSetting();
             $this->dispatchBrowserEvent('hide-delete-modal');
            
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function changeStatus($id) {
        if (Gate::allows('edit_'.$this->gate)) {
            $this->statusSetting($id);
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

}
