<?php

namespace App\Http\Livewire\Admin\Module\Featur\Option;

use Livewire\Component;
use App\Repositories\Contract\IModuleOption;
use App\Repositories\Contract\ILog;


class Add extends Component {

     public $description, $title,$sort,$icon,$languages;
    public $typePage  = 'feature  module option ';
    

   protected $rules = [ 
        "sort"           => "required|integer",
        "icon"           => "required|string",
        "description"    => "required|array|min:1",
        "description.*"  => "required|string|min:3",
        "title"          => "required|array|min:1",
        "title.*"        => "required|string|min:3",
    ];
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
       
     public function getItems() {
        return [
            'type'   => 'feature',
            'sort'   => $this->sort,
            'image'   => $this->icon,
           ];   
    }
    
    public function mount() {
        
        $this->languages = $this->getInterface()->getLanguage();
     
    }
 
    public function getTranslate() {
        
        $translations =[];
        foreach ($this->languages as $lan) {
           
            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';

            $translations[] = [
                'title'            => $title,
                'short_content'    => $content,
                'language_id'      => $lan->language->id
            ];
        }
        return $translations;
        
    }
    
    public function saveInfo() {
        
        $this->validate();
        $translates  = $this->getTranslate();
        $items       = $this->getItems();
        
        $this->getInterface()->create($items,$translates);
 
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'create '. $this->typePage, 
           'url'         =>$this->typePage , 
        ]);

       return (redirect(route('admin.feature.options')))->with('sucsess', 'sucsess');
       
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render() {

        return view('livewire.admin.module.featur.option.add')->layout('layouts.admin');
    }

}
