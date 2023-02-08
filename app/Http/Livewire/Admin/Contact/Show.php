<?php

namespace App\Http\Livewire\Admin\Contact;
use App\Repositories\Contract\{
    IContact
};
use Livewire\Component;

class Show extends Component
{
    public $contact;
    public function getInterface() {

        return app()->make(IContact::class);
    }

    public function mount($id) {
        $this->contact = $this->getInterface()->find($id);
        
    }

    public function render()
    {
        return view('livewire.admin.contact.show')->layout('layouts.admin');
    }
}
