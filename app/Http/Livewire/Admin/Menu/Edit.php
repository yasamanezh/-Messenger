<?php

namespace App\Http\Livewire\Admin\Menu;
use App\Repositories\Contract\{iBlog,ILog,IPost,IMenu,IPage};

use Livewire\Component;

class Edit extends Component
{ 
   
    
    public $menu_id,$slug, $status,$type,$image,$title, $sort,$languages,$parent;
    
    public $typePage  = 'menus';

    protected $rules = [
        'type'      => 'required',
        'parent'      => 'required',
        'status'    => 'required|integer|min:0|max:1',
        'sort'      => 'required|integer',
        "title"     => "required|array|min:1",
        "title.*"   => "required|string|min:3",

    ];
  
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
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
    
    public function getItems() {
        return [
            'slug'      => $this->slug,
            'status'    => $this->status,
            'type'     => $this->type,
            'sort'     => $this->sort,
            'parent'   => $this->parent,

        ];
        
    }
    
    public function getCurrentTitle() {
        
       return $this->getInterface()->getCurrentTitle($this->menu_id); 
    }

    public function saveInfo() {

        $this->validate();
        
        if($this->type == 'blog' || $this->type == 'post'  ){
            $this->validate([
                'slug'  => 'required',
            ]);
        }
        
        $translates  = $this->getTranslate();
        $items       = $this->getItems();
        
        $data        = $this->getInterface()->update($this->menu_id,$items,$translates);
       
        
        $this->createLog([
           'user_id'     => auth()->user()->id, 
           'actionType'  => 'create '. $this->typePage, 
           'url'         => $this->getCurrentTitle(), 
        ]);
        return (redirect(route('admin.menus')))->with('sucsess', 'sucsess');
       
    }

    public function mount($id) {
        
        $data            = $this->getInterface()->find($id);
        $this->languages = $this->getInterface()->getLanguage();
        $this->status    = $data->status;
        $this->menu_id   = $id;
        $this->slug      = $data->slug;
        $this->type      = $data->type;
        $this->sort      = $data->sort;
        $this->parent    = $data->parent;
    
        
        foreach ($this->languages as $value) {
            $code = $data->translate()->where('language_id',$value->language->id)->first();
            if($code){
                $this->title[$value->language->code]            = $code->title  ;
    
            }else{
                $this->title[$value->language->code]            = ''  ;

            }
        }
    }

    public function getInterface() {

        return app()->make(IMenu::class);
    }
    
 
    
    public function render()
    {
        $blogs  = app()->make(IBlog::class)->get();
        $posts  = app()->make(IPost::class)->get();
        $menus  = app()->make(IMenu::class)->get();        
        $pages = app()->make(Ipage::class)->get();


        return view('livewire.admin.menu.edit', compact('blogs','posts','menus','pages'))->layout('layouts.admin');
    }
}
