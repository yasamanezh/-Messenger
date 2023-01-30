<?php

namespace App\Http\Livewire\Admin\Module\Customer\User;

use Livewire\Component;
use App\Repositories\Contract\{IModuleOption,ILog};

use Livewire\WithFileUploads;

class Add extends Component {
use WithFileUploads;
    public $message, $title, $sort, $image, $languages,$name,$job;
    public $typePage = 'clients';
    protected $rules = [
        "sort" => "required|integer",
        "image" => "required|image",
        "message" => "required|array|min:1",
        "message.*" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.*" => "required|string|min:3", 
        "name" => "required|array|min:1",
        "name.*" => "required|string|min:3",
    ];

    public function uploadImage() {
        $directory = "public/photos/modules";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getItems() {
        return [
            'type' => 'client',
            'sort' => $this->sort,
            'image' => $this->uploadImage(),
        ];
    }

    public function mount() {

        $this->languages = $this->getInterface()->getLanguage();
        
        foreach ($this->languages as $value) {
            $this->title[$value->language->code]             = ''  ;
            $this->message[$value->language->code]       = ''  ;
            $this->name[$value->language->code]         = '';
            $this->job[$value->language->code]         = '';
        }
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->message[$lan->language->code] ? $content = $this->message[$lan->language->code] : $content = '';
            $this->name[$lan->language->code] ? $name = ['name' => $this->name[$lan->language->code]] : $name = ['name' => ''];
            $this->job[$lan->language->code] ? $job = ['job' => $this->job[$lan->language->code]] : $job = ['job' => ''];
            $more = array_merge($name, $job);

            $translations[] = [
                'title'         => $title,
                'short_content' => $content,
                'meta'          => json_encode($more),
                'language_id'   => $lan->language->id
            ];
        }
        return $translations;
    }

    public function saveInfo() {

        $this->validate();
        $translates = $this->getTranslate();
        $items = $this->getItems();

        $this->getInterface()->create($items, $translates);


        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'create ' . $this->typePage,
            'url' => $this->typePage,
        ]);

        return (redirect(route('admin.customer.users')))->with('sucsess', 'sucsess');
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render() {
        return view('livewire.admin.module.customer.user.add')->layout('layouts.admin');
    }

}
