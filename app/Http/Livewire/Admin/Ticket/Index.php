<?php

namespace App\Http\Livewire\Admin\Ticket;


use App\Models\Log;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{Ipart,ILog};

class Index extends Component
{

    use WithPagination;

    public $menu;
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
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect = Ticket::where('title', 'LIKE', "%{$this->search}%")
                ->orWhere('link', 'LIKE', "%{$this->search}%")
                ->orWhere('id', $this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item) => (string)$item)->toArray();

        } else {
            $this->mulitiSelect = [];
        }

    }



    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function loadMenu()
    {
        $this->readyToLoad = true;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function confirmRemoval($Id)
    {
        $this->IdBeingRemoved = $Id;

        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_option')) {
            foreach ($this->mulitiSelect as $value) {
                $menu = Ticket::where('id', $value)->first();

                $menu->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
               'url' => 'delete tickets' ,
                'actionType' => 'delete'
            ]);
            $this->SelectPage = false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'success !');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'Access denied.');
        }
    }

    public function delete()
    {
        if (Gate::allows('delete_option')) {
            $data_info_id = Ticket::findOrFail($this->IdBeingRemoved);
            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'delete ticket' ,
                'actionType' => 'delete'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'success');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'Access denied.');
        }


    }
    public function status($id){
        $ticket=Ticket::findOrFail($id);
        if($ticket->status == 0){
            return 'closed';
        }elseif($ticket->status == 'user'){

            return 'Pending';
        }elseif ($ticket->status == 'admin'){
            return 'user answer';
        }else{
            return 'admin answer';
        }
    }

    public function close($id)
    {
        $ticket=Ticket::findOrFail($id);
        if($ticket->status !=0){
            $ticket->status=0;
            $ticket->update();
            $this->emit('toast', 'success', 'success!');
            }

    }
    public function render(Ipart $part)
    {
       $parts    = $part->all('')->get();
        $tickets = $this->readyToLoad ? Ticket::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('description', 'LIKE', "%{$this->search}%")
            ->orWhere('id', $this->search)
            ->orderBy('status', 'DESC')
            ->latest()->paginate($this->count_data) : [];
            $deleteItem = $this->mulitiSelect;


        return view('livewire.admin.ticket.index', compact('tickets', 'deleteItem','parts'))->layout('layouts.admin');
    }
}
