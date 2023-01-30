<?php

namespace App\Http\Livewire\Admin\Help;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{ILog,IHelp};

class Index extends Component
{
    use WithPagination;

    protected $queryString     = ['search'];
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $readyToLoad        = false;
    public $count_data         = 10;
    public $IdBeingRemoved     = null;
    public $mulitiSelect       = [];
    public $sortColumnName     = 'created_at';
    public $sortDirection      = 'desc';
    public $SelectPage         = false;
    public $typePage           = 'faq category';


    public function getInterface() {

        return  app()->make(IHelp::class);

    }
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    public function getCurrentTitle($id) {
        
       return $this->getInterface()->getCurrentTitle($id); 
    }

    public function UpdatedSelectPage($value)  {  
        $param =[$this->search,$this->count_data];
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
        $title = $this->getCurrentTitle($this->IdBeingRemoved);

        $this->getInterface()->delete($this->IdBeingRemoved);
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'delete '. $this->typePage, 
           'url'         => $title, 
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

    public function changeStatus($id)  {

        $this->getInterface()->chanseStatus($id);
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'change Status '. $this->typePage, 
           'url'         => $this->getCurrentTitle($id), 
        ]);
        $this->emit('toast', 'success', 'success !');

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

    public function render(IHelp $help) {

        $datas       = $this->readyToLoad ? $help->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data) : [];
        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.help.index', compact('deleteItem','datas'))->layout('layouts.admin');
        }


}
