<?php

namespace App\Http\Livewire\Admin\PageBuilder;

use Livewire\Component;
use App\Models\PageImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\URL;

class Image extends Component
{
    use WithFileUploads; 
    public $uploadImage;
       public function uploadImage() {
        $directory = "public/photos/modules";
        $name = $this->uploadImage->getClientOriginalName();
        $this->uploadImage->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }
      public function create() {
        
        $this->dispatchBrowserEvent('show-modal');
    }
    
    public function saveInfo(){
        $this->validate([
            'uploadImage'=>'required|image'
        ]);
        
        PageImage::create([
            'file'=> $this->uploadImage()
        ]);
        $this->uploadImage ='';
        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('toast', 'success', 'success !');
    }

    public function cancell() {
        $this->dispatchBrowserEvent('hide-modal');
    }


    public function render()
    {
         $link = URL::to('/');
        $images = PageImage::get();
        return view('livewire.admin.page-builder.image',compact('images','link'))->layout('layouts.admin');
    }
}
