<?php

namespace App\Http\Livewire\Admin\Module\Customer\User;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Repositories\Contract\ILog;
use Livewire\WithFileUploads;

class Edit extends Component {
    use WithFileUploads;

     public $message, $title,$name,$job,$uploadImage,$sort,$image,$languages,$option_id;
    public $typePage  = 'clients ';
    

     protected $rules = [
        "sort" => "required|integer",
        "message" => "required|array|min:1",
        "message.*" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.*" => "required|string|min:3", 
        "name" => "required|array|min:1",
        "name.*" => "required|string|min:3",
    ];
    public function uploadImage(){
        $directory="public/photos/modules";
        $name=$this->uploadImage->getClientOriginalName();
        $this->uploadImage->storeAs($directory,$name);
        return("photos/modules/"."$name");
    }
    
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
       
     public function getItems() {
         
        if($this->uploadImage){
             return [
                'image'  => $this->uploadImage(),
                'type'   => 'client',
                'sort'   => $this->sort,

            ];
         } else {
            return [
                'type'   => 'client',
                'sort'   => $this->sort,
            ];
         }
    }
    
    public function mount($id) {
        
        $data            = $this->getInterface()->find($id);
        

        $this->languages = $this->getInterface()->getLanguage();
        
        foreach ($this->languages as $value) {
           
            $this->title[$value->language->code]             = ''  ;
            $this->message[$value->language->code]       = ''  ;
            $this->name[$value->language->code]         = '';
            $this->job[$value->language->code]         = '';
            
        }
        if($data){
            $this->option_id   = $id;
            $this->sort        = $data->sort;
            $this->image       = $data->image;
            foreach ($this->languages as $value) {
            $code = $data->translate()->where('language_id',$value->language->id)->first();
            if($code){
                $meta = json_decode($code->meta,true);
                
                $this->title[$value->language->code]             = $code->title  ;
                $this->message[$value->language->code] = $code->short_content;
                
                if($meta && $meta['name']){
                   $this->name[$value->language->code]    = $meta['name']; 
                }
                if($meta && $meta['job']){
                   $this->job[$value->language->code]     = $meta['job']; 
                }
            }
        }
        } 
     
    }
 
    public function getTranslate() {
        
        $translations =[];
        foreach ($this->languages as $lan) {
           
            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->message[$lan->language->code] ? $content = $this->message[$lan->language->code] : $content = '';
            $this->name[$lan->language->code] ? $name =['name'=> $this->name[$lan->language->code]]  : $name = ['name'=> ''];
            $this->job[$lan->language->code] ? $job =['job'=> $this->job[$lan->language->code]]  : $job = ['job'=> ''];
            $more = array_merge($name,$job);

            $translations[] = [
                'title'            => $title,
                'short_content'    => $content,
                'meta'             => json_encode($more),
                'language_id'      => $lan->language->id
            ];
        }
        return $translations;
        
    }
    
    public function saveInfo() {
        
        $this->validate();
        if($this->uploadImage){
            $this->validate([
                'uploadImage' => 'required|image',
            ]);
        }
        $translates  = $this->getTranslate();
        $items       = $this->getItems();
        
        $this->getInterface()->update($this->option_id,$items,$translates);
 
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'create '. $this->typePage, 
           'url'         =>$this->typePage , 
        ]);

       return (redirect(route('admin.customer.users')))->with('sucsess', 'sucsess');
       
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render()
    {
        return view('livewire.admin.module.customer.user.edit')->layout('layouts.admin');
    }
}
