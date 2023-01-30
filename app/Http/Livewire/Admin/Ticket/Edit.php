<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Answer;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $description,$file;

    public function uploadImage()
    {
        $directory = "photos/tickets";
        $name = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ($directory.'/'.$name);
    }


    public function saveInfo(){

        $this->validate([
            'description'=>'required|string|min:2',
            'file'=>'nullable||image|max:200|mimes:jpg,png,jpeg,gif',
        ]);
        $answer=new Answer();
        $answer->user_id=auth()->user()->id;
        $answer->answer=$this->description;
        $answer->ticket_id=$this->ticket->id;
        if($this->file){
            $answer->file=$this->uploadImage();
        }
        $answer->save();
        $ticket=$this->ticket;
        $ticket->status='admin';
        $ticket->update();
        redirect(route('admin.tickets'));
    }

    public function mount($id)
    {
        $this->ticket=Ticket::findOrFail($id);

    }

    public function render()
    {

        return view('livewire.admin.ticket.edit')->layout('layouts.admin');
    }
}