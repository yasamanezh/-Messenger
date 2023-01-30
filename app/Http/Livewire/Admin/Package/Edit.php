<?php

namespace App\Http\Livewire\Admin\Package;

use Livewire\Component;
use App\Repositories\Contract\{ILog,IPack,IOption};
use Illuminate\Support\Facades\Gate;
class Edit extends Component
{
   
     public $pack_id,$sort, $status,$options=[],$description,$image,$title, $price, $languages;
    public $typePage  = 'packages';
    

      protected $rules = [
        'sort'               => 'required|integer|min:1',
        'status'             => 'required|integer|min:0|max:1',
        'price'             => 'required|integer|min:0',
        "description"        => "nullable|array|min:1",
        "description.*"      => "nullable|string|min:3",
        "title"              => "required|array|min:1",
        "title.*"            => "required|string|min:3",
    ];
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    public function getCurrentTitle() {
        
       return $this->getInterface()->getCurrentTitle($this->post_id); 
    }
        
     public function getItems() {
        
            return [
                'sort'      => $this->sort,
                'status'    => $this->status,
                'price'     => $this->price,

            ];
        
    }
    
    public function mount($id) {
        if (!Gate::allows('show_pack')) {
            abort(403);
        }
        $data            = $this->getInterface()->find($id);
  
        
        $this->languages = $this->getInterface()->getLanguage();
        $this->status    = $data->status;
        $this->pack_id   = $id;
        $this->sort      = $data->sort;
        $this->price     = $data->price;
        
        
        foreach($this->getInterface()->getPackOptions($id) as $option){
            array_push($this->options,$option->id);
        }
    
        
        foreach ($this->languages as $value) {
            $code = $data->translate()->where('language_id',$value->language->id)->first();
            if($code){
                $this->title[$value->language->code]            = $code->title  ;
                $this->description[$value->language->code]      = $code->content  ;
            }else{
                $this->title[$value->language->code]            = ''  ;
                $this->description[$value->language->code]      = ''  ;
            }
        }
    }
 
    public function getTranslate() {
        
        $translations =[];
        foreach ($this->languages as $lan) {

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';


            $translations[] = [
                'title'            => $title,
                'content'          => $content,
                'language_id'      => $lan->language->id
            ];
        }
        return $translations;
        
    }
    
    public function saveInfo() {
        if (Gate::allows('edit_pack')) {
            $this->validate();

            $translates = $this->getTranslate();
            $items = $this->getItems();
            $this->getInterface()->update($this->pack_id, $items, $translates);
            $this->getInterface()->syncOption($this->pack_id, $this->options);
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($this->pack_id),
            ]);

            return (redirect(route('admin.packs')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function getInterface() {

        return app()->make(IPack::class);
    }

    public function render()
    {
        $Alloption  = app()->make(IOption::class)->get();
        return view('livewire.admin.package.edit',compact('Alloption'))->layout('layouts.admin');
    }
}
