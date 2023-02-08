<?php

namespace App\Http\Livewire\Admin\Contact;


use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{IContact};
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\General;

class Index extends Component {

    use WithPagination;
    use General;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'contact';
    public $typePage = 'contact';
    
    public function mount() {
         if (!Gate::allows('show_contact')) {
             abort(403); 
        } 
    }

    public function getInterface() {

        return app()->make(IContact::class);
    }
  

    public function render(IContact $contact)
    {

        $contacts = $this->readyToLoad ? $contact->getContact($this->search,$this->sortColumnName,$this->sortDirection,$this->count_data)
         : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.contact.index', compact('deleteItem', 'contacts'))->layout('layouts.admin');
    }
}
