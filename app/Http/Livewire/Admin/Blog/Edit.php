<?php

namespace App\Http\Livewire\Admin\Blog;

use Livewire\Component;
use App\Repositories\Contract\iBlog;
use App\Traits\Admin\UpdateSettinges;
use Illuminate\Support\Facades\Gate;

class Edit extends Component {

    use UpdateSettinges;
     
    public $module_id,$slug, $status, $title, $meta_keyword = [], $meta_title = [], $meta_description = [], $languages;
    public $typePage = 'Blog Category';
    public $Translateparams  =['title','meta_keyword','meta_title','meta_description'];
    public $IndexRoute       = 'admin.blogs';
    public $gate             ='design';
    protected $rules = [
        'status'             => 'required|integer|min:0|max:1',
        "title"              => "required|array|min:1",
        "title.en"           => "required|string|min:2",
        "meta_keyword.en"     => "nullable|string|min:2",
        "meta_title.en"       => "nullable|string|min:2",
        "meta_description.en" => "nullable|string|min:2",
    ];

   
    public function getItems() {
        return [
            'slug' => $this->slug,
            'status' => $this->status,
             'archive'=> json_encode($this->archive)
        ];
    }

    public function mount($id) {
         $now = [now()->format('M Y')]; 
        $this->module_id  = $id;
        if (!Gate::allows('show_blog')) {
            abort(403);
        }
        $data = $this->getInterface()->find($id);
        $this->starterDate($data, $this->Translateparams);
        if($data){
            $this->languages = $this->getInterface()->getLanguage();
            $this->status = $data->status;
            $this->slug = $data->slug; 
            $this->archive   = json_decode($data->archive);
            if(! in_array(now()->format('M Y'),json_decode($data->archive))){
                $this->archive   = array_merge(json_decode($data->archive),$now);
            }
        }

    }


    public function getInterface() {

        return app()->make(iBlog::class);
    }

    public function render() {
        return view('livewire.admin.blog.edit')->layout('layouts.admin');
    }

}
