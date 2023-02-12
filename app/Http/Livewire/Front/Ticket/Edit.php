<?php

namespace App\Http\Livewire\Front\Ticket;

use App\Repositories\Contract\{
    ITicket
};
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\Translate;

class Edit extends Component {

    use WithFileUploads;
    use Translate;

    public  $ticket;
    public $description, $file;
    public $inputdownload = [], $download_file;
    public $typePage = 'tickets';
    public $l = 1;
    public $multiLanguage = false;
    public $status,$success;
    public $message;
    
    public function test() {
        $this->validate([
            'message'=>'required'
        ]);
        
    }

    public function mount($language = null, $id = null)  {
      
            $this->ticket = Ticket::findOrFail($id);
        if( $this->ticket->status == 'close'){
            $this->status = 'close';
        }elseif ( $this->ticket->status == 'admin_answerd'){
            $this->status = 'admin answer';
        }elseif ( $this->ticket->status == 'user_answerd'){
            $this->status = 'user answer';
        }else{
            $this->status = 'open';
        }
        
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
    }

    public function uploadImage() {
        $directory = "public/photos/tickets";
        $name = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ('photos/tickets/' . $name);
    }

    public function AddDownload($l) {
        $l = $l + 1;
        $this->l = $l;
        array_push($this->inputdownload, $l);
    }

    public function removeDownload($l) {
        unset($this->inputdownload[$l]);
        unset($this->download_file[$l]);
    }

    public function uploadFile() {
        $directory = "public/photos/tickets";
        $name = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ('photos/tickets/' . $name);
    }

    public function getInterface() {

        return app()->make(ITicket::class);
    }

    public function saveInfo() {

        
        $this->validate([
            'message' => 'required|string',
        ]);
        
     
        $data = [
            'user_id' => auth()->user()->id,
            'answer' => $this->message,
            'ticket_id' => $this->ticket->id,
        ];

        $downloads = [];
        if ($this->download_file) {
            foreach ($this->download_file as $key => $value) {
                if ($value) {
                    $this->validate([
                        "download_file.$key" => 'image|mimes:jpg,bmp,png,jpeg,gif,webp,svg',
                            ], [
                        'download_file.*.mimes' => 'the file mimes is jpg,bmp,png,jpeg,gif,webp,svg . ',
                        'download_file.*.image' => 'the file must be a image.',
                    ]);
                    $directory = "photos/tickets";
                    $name = $this->download_file[$key]->getClientOriginalName();
                    $this->download_file[$key]->storeAs($directory, $name);

                    $downloads[] = ['file' => "$directory/$name"];
                }
            }
        }
        
        $this->getInterface()->createAttachAnswer($data, $downloads);


        $ticket = $this->ticket;
        $ticket->status = 'user_answerd';
        $ticket->update();
        $this->reset('description');
        $this->success ="success !";
    }
    
    public function getParts() {

        return  app()->make(\App\Repositories\Contract\Ipart::class);

    }

    public function render() {
        $parts    = $this->getParts()->get();
        return view('livewire.front.ticket.edit', compact('parts'));
    }

}
