<?php

namespace App\Http\Livewire\Admin\Role;


use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{ILog,IRole};

class Index extends Component
{
    use WithPagination;

    public $category;
    public $readyToLoad = false;
    public $search;
    public $mulitiSelect = [];
    public $count_data = 10;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $IdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;
    public $typePage          ='roles';


    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    
    public function getInterface() {

        return  app()->make(IRole::class);

    }

    public function UpdatedSelectPage($value)  {  
        $param =['url',$this->search,$this->count_data];
        $this->mulitiSelect = $this->getInterface()->UpdatedSelectPage($value,$param);

    }

    public function confirmRemoval($categoryId)  {
        $this->IdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllRemoval() {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll() {        
        $this->getInterface()->deleteAll($this->mulitiSelect);
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'Mass deletion', 
           'url'         => $this->typePage, 
        ]);
        $this->mulitiSelect = [];
        $this->SelectPage = false;
        $this->dispatchBrowserEvent('hide-form');
        $this->emit('toast', 'success', 'success !');

    }

    public function delete()  {
        
        $name = $this->getInterface()->find($this->IdBeingRemoved)->name;
        
        $this->getInterface()->delete($this->IdBeingRemoved);
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'delete '. $this->typePage, 
           'url'         => $name, 
        ]);
        $this->dispatchBrowserEvent('hide-delete-modal');
        $this->emit('toast', 'success', 'success !');
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
    
    public function render()
    {
        $data_info = $this->readyToLoad ? $this->getInterface()->all('label',$this->search)
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.role.index', compact('data_info', 'deleteItem'))->layout('layouts.admin');
    }
}
