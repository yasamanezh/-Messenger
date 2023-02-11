<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Repositories\Contract\{ITicket};
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $description,$file;
        public $inputdownload = [], $download_file;
    public $typePage  ='tickets';
    public $l         = 1;

    public function uploadImage()
    {
        $directory = "public/photos/tickets";
        $name = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ('photos/tickets/'.$name);
    }
   public function AddDownload($l)
    {
        $l = $l + 1;
        $this->l = $l;
        array_push($this->inputdownload, $l);
    }
    
    public function removeDownload($l)
    {
        unset($this->inputdownload[$l]);
        unset($this->download_file[$l]);

    }
     public function uploadFile()
    {
        $directory   = "public/photos/tickets";
        $name        = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ('photos/tickets/'.$name);
    }
     public function getInterface() {

        return  app()->make(ITicket::class);

    }


    public function saveInfo(){

        $this->validate([
            'description'=>'nullable|string|min:2',
        ]);
        $data = [
         'user_id'=>auth()->user()->id,
        'answer'=>$this->description,
        'ticket_id'=>$this->ticket->id,
       ];
     
        $downloads = [];
        if ($this->download_file) {
            foreach ($this->download_file as $key => $value) {
                if($value){
                $this->validate([
                    "download_file.$key" => 'image|mimes:jpg,bmp,png,jpeg,gif,webp,svg',
                ], [
                    'download_file.*.mimes' => 'the file mimes is jpg,bmp,png,jpeg,gif,webp,svg . ',
                    'download_file.*.image' => 'the file must be a image.',
                ]);
                $directory = "photos/tickets";
                $name = $this->download_file[$key]->getClientOriginalName();
                $this->download_file[$key]->storeAs($directory, $name);

                $downloads[] = [  'file' => "$directory/$name"];
                }
            }
        }
        $this->getInterface()->createAttachAnswer($data,$downloads);
     
       
        $ticket=$this->ticket;
        $ticket->status='admin_answerd';
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
