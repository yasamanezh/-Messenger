<?php

namespace App\Http\Livewire\Admin\Ticket;


use Livewire\Component;
use App\Repositories\Contract\{Ipart,ILog,IUser,ITicket};
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $file,$user,$ticket;
    public $title,$description,$part;
    public $inputdownload = [], $download_file;
    public $typePage  ='tickets';
    public $l         = 1;

    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
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
    
    protected $rules=[
        'user'       =>'required|exists:users,id',
        'title'       =>'required|string|min:2',
        'description' =>'required|string|min:2',
        'part'        =>'required|string|exists:parts,id',
    ];

    
    public function uploadFile()
    {
        $directory   = "public/photos/tickets";
        $name        = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ('photos/tickets/'.$name);
    }


    public function saveInfo(){
        $this->validate();

       $data = [
        'user_id'       => $this->user,
        'title'       =>$this->title,
        'description' =>$this->description,
        'part'        =>$this->part,
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
        $this->getInterface()->createAttach($data,$downloads);
        redirect(route('admin.tickets'));

    }
    public function render()
    {
        $parts    = $this->getParts()->get();
        $users    = $this->getUsers()->all('id','')->get();

        return view('livewire.admin.ticket.add',compact('users','parts'))->layout('layouts.admin');
    }
}
