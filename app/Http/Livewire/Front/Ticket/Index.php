<?php

namespace App\Http\Livewire\Front\Ticket;


use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\Ipart;

class Index extends Component {

    use WithPagination;

    public $multiLanguage = false;

    public function mount($language = null) {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
    }

    protected $paginationTheme = 'bootstrap';
   public function status($id){
        $ticket=Ticket::findOrFail($id);
        if($ticket->status == 'close'){
            return 'close';
        }elseif ($ticket->status == 'admin_answerd'){
            return 'admin answer';
        }elseif ($ticket->status == 'user_answerd'){
            return 'user answer';
        }else{
            return 'open';
        }
    }

    public function render(Ipart $part) {
        $parts = $part->all('')->get();
        $tickets =  Ticket::latest()->paginate(12) ;
      

        return view('livewire.front.ticket.index', compact('tickets', 'parts'))->layout('layouts.app');
    }

}
