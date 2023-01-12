<?php

namespace App\Http\Livewire\Admin\Blog;

use Livewire\Component;
use App\Repositories\Contract\iBlog;
use Illuminate\Validation\Rule;


class Edit extends Component
{
    public $blog_id,$slug, $status, $title, $meta_keyword, $meta_title , $meta_description, $languages;
    
    protected $rules = [
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.*"            => "required|string|min:3",
        "meta_keyword"       => "array",
        "meta_keyword.*"     => "string|min:3",
        "meta_title"         => "array",
        "meta_title.*"       => "string|min:3",
        "meta_description"   => "array",
        "meta_description.*" => "string|min:3",
    ];
        
    public function getItems() {
        return [
            'slug'   => $this->slug,
            'status' => $this->status,
        ];
        
    }
    
    public function mount($id) {
        
        $data            = $this->getInterface()->find($id);
        $this->languages = $this->getInterface()->getLanguage();
        $this->status    = $data->status;
        $this->blog_id   = $id;
        $this->slug      = $data->slug;
        
        foreach ($this->languages as $value) {
            $code = $data->translate()->where('language_id',$value->id)->first();
            if($code){
                $this->title[$value->code]            = $code->title  ;
                $this->meta_title[$value->code]       = $code->meta_title;
                $this->meta_keyword[$value->code]     = $code->meta_keyword ; 
                $this->meta_description[$value->code] = $code->meta_description ;
            }else{
                $this->title[$value->code]            = ''  ;
                $this->meta_title[$value->code]       = '';
                $this->meta_keyword[$value->code]     = '' ; 
                $this->meta_description[$value->code] = '';
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
    
    public function saveInfo() {
        
        $this->validate();
        $this->validate([
            'slug' => ['required', 'string',Rule::unique('blogs')->ignore($this->blog_id)],
        ]);
        $translates  = $this->getTranslate();
        $items       = $this->getItems();

        $this->getInterface()->update($this->blog_id,$items,$translates);
        return (redirect(route('admin.blogs')))->with('sucsess', 'sucsess');
       
    }

    public function getInterface() {

        return app()->make(iBlog::class);
    }

    public function render() {
        return view('livewire.admin.blog.edit')->layout('layouts.admin');
    }
}
