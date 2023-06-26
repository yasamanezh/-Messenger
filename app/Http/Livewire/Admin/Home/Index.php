<?php

namespace App\Http\Livewire\Admin\Home;

use Livewire\Component;
use App\Models\{User,Comment,Contact,Ticket};
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    public $usersCount,$ComentCount,$massageCount,$ticketCount;
    public function mount() {
         if (!Gate::allows('show_dashboard')) {
            abort(403);
        }
       // \Illuminate\Support\Facades\Artisan::call('down --secret="demo"');
       $this->usersCount   = $this->getUsersCount('TODAY');
       $this->ComentCount  = $this->getComentCount('TODAY');
       $this->massageCount = $this->getComentCount('TODAY');
       $this->ticketCount  = $this->getTicketCount('TODAY');
    }
     public function getUsersCount($option = 'TODAY')
    {
        return $this->usersCount = User::query()
            ->whereBetween('created_at', $this->getDateRange($option))
            ->count();
    }
     public function getTicketCount($option = 'TODAY')
    {
        return $this->ticketCount = Ticket::query()
            ->whereBetween('created_at', $this->getDateRange($option))
            ->count();
    }
    
    
 
    public function getComentCount($option = 'TODAY') {
          return $this->ComentCount = Comment::query()
            ->whereBetween('created_at', $this->getDateRange($option))
            ->count();
    }
    public function getcontactCount($option = 'TODAY') {
          return $this->massageCount = Contact::query()
            ->whereBetween('created_at', $this->getDateRange($option))
            ->count();
    }
    
    
    public function getDateRange($option)
    {
        if ($option == 'TODAY') {
            return [now()->today(), now()];
        }
        if ($option == 'MTD') {
            return [now()->firstOfMonth(), now()];
        }
        if ($option == 'YTD') {
            return [now()->firstOfYear(), now()];
        }
        return [now()->subDays($option), now()];
    }

    public function render()
    {
        $comments = Comment::get();
        
        return view('livewire.admin.home.index', compact('comments'))->layout('layouts.admin');
    }
}
