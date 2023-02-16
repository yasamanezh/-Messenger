<?php

namespace App\Http\Livewire\Front\Ticket;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\Ipart;
use App\Traits\Translate;

class Index extends Component {

    use WithPagination;
    use Translate;

    public $multiLanguage = false;

    public function mount($language = null) {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
       
      
    }

    protected $paginationTheme = 'bootstrap';

    public function status($id) {
        $ticket = Ticket::findOrFail($id);
        if ($ticket->status == 'close') {
            return 'closed';
        } elseif ($ticket->status == 'user_answerd') {
            return 'waiting for an answer';
        } elseif ($ticket->status == 'admin_answerd') {
            return 'answerd';
        } else {
            return 'waiting for an answer';
        }
    }

    public function render(Ipart $part) {
        $parts = $part->all('')->get();
        $tickets = Ticket::where('user_id', auth()->user()->id)->latest()->paginate(12);

        return view('livewire.front.ticket.index', compact('tickets', 'parts'));
    }

}
