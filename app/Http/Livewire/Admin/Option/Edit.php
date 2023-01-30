<?php

namespace App\Http\Livewire\Admin\Option;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\{ILog,IOption};

class Edit extends Component
{
    public $option_id,$sort, $status, $title, $languages;
    public $typePage  = 'package option';
    
    protected $rules = [
        'status'             => 'required|integer|min:0|max:1',
        'sort'             => 'required|integer|min:1',
        "title"              => "required|array|min:1",
        "title.*"            => "required|string|min:3",

    ];
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }
    
    public function getCurrentTitle() {
        
       return $this->getInterface()->getCurrentTitle($this->option_id); 
    }

        
    public function getItems() {
        return [
            'sort'   => $this->sort,
            'status' => $this->status,
        ];
        
    }
    
    public function mount($id) {
        if (!Gate::allows('show_option')) {
            abort(403);
        }
        $data            = $this->getInterface()->find($id);
        $this->languages = $this->getInterface()->getLanguage();
        $this->status    = $data->status;
        $this->option_id   = $id;
        $this->sort      = $data->sort;
        
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
        if (Gate::allows('edit_option')) {
            $this->validate();
            $translates = $this->getTranslate();
            $items = $this->getItems();

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($this->option_id),
            ]);

            $this->getInterface()->update($this->option_id, $items, $translates);
            return (redirect(route('admin.pack.options')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function getInterface() {

        return app()->make(IOption::class);
    }

    public function render()
    {
        return view('livewire.admin.option.edit')->layout('layouts.admin');
    }
}
