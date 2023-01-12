<?php

namespace App\Http\Livewire\Admin\Blog;

use Livewire\Component;
use App\Repositories\Contract\iBlog;


class Add extends Component {

    public $slug, $status, $title, $meta_keyword=[], $meta_title=[] , $meta_description=[], $languages;
    
    protected $rules = [
        'slug'               => 'required|string|min:2|max:199||unique:blogs,slug',
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.*"            => "required|string|min:3",
        "meta_keyword.*"     => "string|min:3",
        "meta_title.*"       => "string|min:3",
        "meta_description.*" => "string|min:3",
    ];
    
    public function getTranslate() {
        
        $translations =[];
        foreach ($this->languages as $lan) {
            $meta_title       = '';
            $meta_keyword     = '';
            $meta_description = '';

            $this->title[$lan->code] ? $title = $this->title[$lan->code] : $title = '';

            if ($this->meta_title && $this->meta_title[$lan->code]) {
                $meta_title = $this->meta_title[$lan->code] ;
            }
            if ($this->meta_keyword && $this->meta_keyword[$lan->code]) {
                $meta_keyword = $this->meta_keyword[$lan->code] ;
            }
            if ($this->meta_description && $this->meta_description[$lan->code] ) {
                $meta_description = $this->meta_description[$lan->code] ;
            }

            $translations[] = [
                'title'            => $title,
                'meta_title'       => $meta_title,
                'meta_keyword'     => $meta_keyword,
                'meta_description' => $meta_description,
                'language_id'      => $lan->id
            ];
        }
        return $translations;
        
    }
    
    public function getItems() {
        return [
            'slug'   => $this->slug,
            'status' => $this->status,
        ];
        
    }

    public function saveInfo() {
        
        $this->validate();       
        $translates  = $this->getTranslate();
        $items       = $this->getItems();
     
        $this->getInterface()->create($items,$translates);
        return (redirect(route('admin.blogs')))->with('sucsess', 'sucsess');
       
    }

    public function mount() {
        $this->status    = 1;
        $this->languages = $this->getInterface()->getLanguage();
    }

    public function getInterface() {

        return app()->make(iBlog::class);
    }

    public function render() {

        return view('livewire.admin.blog.add')->layout('layouts.admin');
    }

}
