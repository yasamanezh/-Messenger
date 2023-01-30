<?php

namespace App\Http\Livewire\Admin\Package;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\{IOption,IPack,ILog};


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
    public $typePage           = 'packages';

    public function mount() {
        if (!Gate::allows('show_pack')) {
            abort(403);
        }
    }
    public function getInterface() {

        return  app()->make(IPack::class);

    }
    
    public function AllCategry() {

        return  app()->make(IOption::class);

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
         if (Gate::allows('delete_pack')) {
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
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'permission denied !');
        }
        

    }

    public function delete()  {
        if (Gate::allows('delete_pack')) {
            $title = $this->getCurrentTitle($this->IdBeingRemoved);

        $this->getInterface()->delete($this->IdBeingRemoved);
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'delete '. $this->typePage, 
           'url'         => $title, 
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

    public function changeStatus($id)  {
        if (Gate::allows('edit_pack')) {
            $this->getInterface()->chanseStatus($id);
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'change Status ' . $this->typePage,
                'url' => $this->getCurrentTitle($id),
            ]);
            $this->emit('toast', 'success', 'success !');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
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

    public function render(IPack $pack) {

        $datas       = $this->readyToLoad ? $pack->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data) : [];
        $categories  = $this->AllCategry()->all('')->get();

        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.package.index',compact('deleteItem','datas','categories'))->layout('layouts.admin');
    }
}