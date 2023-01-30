<?php

namespace App\Http\Livewire\Admin\Help;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Repositories\Contract\{ILog,IHelp};


class Edit extends Component
{
    public $help_id,$status, $title, $languages;
    public $typePage  = 'faq category';
    
    protected $rules = [
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.*"            => "required|string|min:3",
    ];
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    public function getCurrentTitle() {
        
       return $this->getInterface()->getCurrentTitle($this->help_id); 
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
        $this->help_id   = $id;

        
        foreach ($this->languages as $value) {
            $code = $data->translate()->where('language_id',$value->language->id)->first();
            if($code){
                $this->title[$value->language->code]            = $code->title  ;
            }else{
                $this->title[$value->language->code]            = ''  ;
            }
        }
    }
 
    public function getTranslate() {
        
        $translations =[];
        foreach ($this->languages as $lan) {
          
            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';

            $translations[] = [
                'title'            => $title,
                'language_id'      => $lan->language->id
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
           'url'         => $this->getInterface()->getCurrentTitle($this->help_id), 
        ]);

        $this->getInterface()->update($this->help_id,$items,$translates);
        return (redirect(route('admin.helps')))->with('sucsess', 'sucsess');
       
    }

    public function getInterface() {

        return app()->make(IHelp::class);
    }

    public function render() {
        return view('livewire.admin.help.edit')->layout('layouts.admin');
    }
}
