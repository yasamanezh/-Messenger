<?php

namespace App\Http\Livewire\Admin\Faq;

use Livewire\Component;
use App\Repositories\Contract\{IFaq,ILog,IHelp};
class Edit extends Component
{
     public $faq_id,$description, $status, $title, $languages;
    public $typePage  = 'faq';
    

   protected $rules = [
        'category'           => 'required|exists:helps,id',
        'status'             => 'required|integer|min:0|max:1',
        "description"        => "required|array|min:1",
        "description.*"      => "required|string|min:3",
        "title"              => "required|array|min:1",
        "title.*"            => "required|string|min:3",
    ];
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    public function getCurrentTitle() {
        
       return $this->getInterface()->getCurrentTitle($this->faq_id); 
    }

        
     public function getItems() {
        return [
           'status'    => $this->status,
           'help_id'     => $this->category,
           ];
       
    }
    
    public function mount($id) {
        
        $data            = $this->getInterface()->find($id);
  
        
        $this->languages = $this->getInterface()->getLanguage();
        $this->status    = $data->status;
        $this->faq_id   = $id;
        $this->category  = $data->help_id;
    
        
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
        
        $this->validate();
       
     
        $translates  = $this->getTranslate();
        $items       = $this->getItems();
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'edit '. $this->typePage, 
           'url'         => $this->getInterface()->getCurrentTitle($this->faq_id), 
        ]);

        $this->getInterface()->update($this->faq_id,$items,$translates);
        return (redirect(route('admin.faqs')))->with('sucsess', 'sucsess');
       
    }

    public function getInterface() {

        return app()->make(IFaq::class);
    }

    public function render()
    {
        $categories  = app()->make(IHelp::class)->get();
        return view('livewire.admin.faq.edit',compact('categories'))->layout('layouts.admin');
    }
}
