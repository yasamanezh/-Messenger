<?php

namespace App\Http\Livewire\Admin\Ticket\Part;

use Livewire\Component;
use App\Repositories\Contract\Ipart;
use Illuminate\Validation\Rule;
use App\Repositories\Contract\ILog;

class Edit extends Component
{
    public $part_id, $status, $title, $languages;
    public $typePage  = 'part';
    
    protected $rules = [
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.*"            => "required|string|min:3",
    ];
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    public function getCurrentTitle() {
        
       return $this->getInterface()->getCurrentTitle($this->part_id); 
    }

        
    public function getItems() {
        return [
            'status' => $this->status,
        ];
        
    }
    
    public function mount($id) {
        
        $data            = $this->getInterface()->find($id);
        $this->languages = $this->getInterface()->getLanguage();
        $this->status    = $data->status;
        $this->part_id   = $id;

        
        foreach ($this->languages as $value) {
            $code = $data->translate()->where('language_id',$value->id)->first();
            if($code){
                $this->title[$value->code]            = $code->title  ;
            }else{
                $this->title[$value->code]            = ''  ;
            }
        }
    }
 
    public function getTranslate() {
        
        $translations =[];
        foreach ($this->languages as $lan) {
            $meta_title       = '';
            $meta_keyword     = '';
            $meta_description = '';

            $this->title[$lan->code] ? $title = $this->title[$lan->code] : $title = '';

            $translations[] = [
                'title'            => $title,
                'language_id'      => $lan->id
            ];
        }
        return $translations;
        
    }
    
    public function saveInfo() {
        
        $this->validate();
        $translates  = $this->getTranslate();
        $items       = $this->getItems();
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'edit '. $this->typePage, 
           'url'         => $this->getInterface()->getCurrentTitle($this->part_id), 
        ]);

        $this->getInterface()->update($this->part_id,$items,$translates);
        return (redirect(route('admin.tickets.part')))->with('sucsess', 'sucsess');
       
    }

    public function getInterface() {

        return app()->make(Ipart::class);
    }

    public function render() {
        return view('livewire.admin.ticket.part.edit')->layout('layouts.admin');
    }
}
