<?php

namespace App\Http\Livewire\Front\Ticket;


use Livewire\Component;
use App\Repositories\Contract\{Ipart,ILog,IUser,ITicket};
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $file,$user,$ticket;
    public $subject,$message,$part_id;
    public $inputdownload = [], $download_file;
    public $typePage  ='tickets';
    public $l         = 1;
      
     public $multiLanguage = false;
    public $status,$success;

    public function mount($language = null)  {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
    }

   
    
    public function getUsers() {
        
       return app()->make(IUser::class); 
    }
    
    public function getInterface() {

        return  app()->make(ITicket::class);

    }

    public function getParts() {

        return  app()->make(Ipart::class);

    }
    
    public function AddDownload($l) {
        $l = $l + 1;
        $this->l = $l;
        array_push($this->inputdownload, $l);
    }
    
    public function removeDownload($l)  {
        unset($this->inputdownload[$l]);
        unset($this->download_file[$l]);

    }
    
    public function uploadFile() {
        $directory   = "public/photos/tickets";
        $name        = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ('photos/tickets/'.$name);
    }

    public function saveInfo(){
        
        $this->validate([
        'subject'       =>'required|string|min:2',
        'message' =>'required|string|min:2',
        'part_id'        =>'required|string|exists:parts,id',
        ]);


       $data = [
        'user_id'      => auth()->user()->id,
        'title'       =>$this->subject,
        'description' =>$this->message,
        'status'      =>'open',
        'part'        =>$this->part_id,
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
                $directory = "pubic/photos";
                $name = $this->download_file[$key]->getClientOriginalName();
                $this->download_file[$key]->storeAs($directory, $name);

                $downloads[] = [  'file' => "$directory/$name"];
                }
            }
        }
        $this->getInterface()->createAttach($data,$downloads);
        $this->success ="success !";
        if($this->multiLanguage){
             return redirect(route('front.ticket.language',app()->getLocale()));
        }else{
             return redirect(route('front.ticket'));
        }
      

    }
    
    public function render()
    {
        $parts    = $this->getParts()->get();
        $users    = $this->getUsers()->all('id','')->get();

        return view('livewire.front.ticket.add',compact('users','parts'));
    }
}
