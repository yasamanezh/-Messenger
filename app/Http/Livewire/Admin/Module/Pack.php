<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;

use App\Repositories\Contract\{ILog,IModule};


class Pack extends Component
{
    public $module_id , $short_description, $title,$more_text =[],$more_link  =[] ,$languages;
    public $is_module =false;
    public $typePage  = 'pack module';
    

   protected $rules = [
        "short_description"    => "required|array|min:1",
        "short_description.*"  => "required|string|min:3", 
        
        "title"                => "required|array|min:1",
        "title.*"              => "required|string|min:3",      
        "more_link"             => "nullable|array|min:1",
        "more_link.*"          => "nullable|string|min:3",
       "more_text"             => "nullable|array|min:1",
        "more_text.*"          => "nullable|string|min:3",
    ];
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
       
     public function getItems() {
         
            return [
                'type'              => 'pack',
            ];         
    }

    public function mount() {
        
        
        $data            = $this->getInterface()->firstByType('pack');
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {
           
            $this->title[$value->language->code]             = ''  ;
            $this->short_description[$value->language->code] = '';
            $this->more_text[$value->language->code]         = '';
            $this->more_link[$value->language->code]         = '';
            
        }
        
        if($data){
            $this->is_module   = true;
            $this->module_id   = $data->id;

            foreach ($this->languages as $value) {
            $code = $data->translate()->where('language_id',$value->language->id)->first();
            if($code){
                $meta = json_decode($code->meta,true);
                $this->title[$value->language->code]             = $code->title  ;
                $this->short_description[$value->language->code] = $code->short_content;
                if($meta && $meta['more_text']){
                   $this->more_text[$value->language->code]         = $meta['more_text']; 
                }
                if($meta && $meta['more_link']){
                   $this->more_link[$value->language->code]         = $meta['more_link']; 
                }
                

            }
        }
        } 
        
    }
 
    public function getTranslate() {
        
        $translations =[];
        foreach ($this->languages as $lan) {
           
            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->short_description[$lan->language->code] ? $shoret_content = $this->short_description[$lan->language->code] : $shoret_content = '';
            $this->more_text[$lan->language->code] ? $more_text =['more_text'=> $this->more_text[$lan->language->code]]  : $more_text = ['more_text'=> ''];
            $this->more_link[$lan->language->code] ? $more_link =['more_link'=> $this->more_link[$lan->language->code]]  : $more_link = ['more_link'=> ''];
            $more = array_merge($more_link,$more_text);

            $translations[] = [
                'title'            => $title,
                'short_content'    => $shoret_content,
                'meta'             => json_encode($more),
                'language_id'      => $lan->language->id
            ];
        }
        return $translations;
        
    }
    
    public function saveInfo() {

        
        $this->validate();
        
        $translates  = $this->getTranslate();
        $items       = $this->getItems();
        
        if($this->is_module){
            $this->getInterface()->update($this->module_id,$items,$translates);
        }else{
            $this->getInterface()->create($items,$translates);
        }
 
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'edit '. $this->typePage, 
           'url'         =>$this->typePage , 
        ]);

        
       return (redirect(route('admin.modules')))->with('sucsess', 'sucsess');
       
    }

    public function getInterface() {

        return app()->make(IModule::class);
    }

    public function render()
    {
        return view('livewire.admin.module.pack')->layout('layouts.admin');
    }
}
