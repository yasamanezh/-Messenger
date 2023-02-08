<?php

namespace App\Http\Livewire\Admin\Help;

use Livewire\Component;
use App\Repositories\Contract\{
    ILog,
    IHelp
};

class Add extends Component {

    public $status, $title, $languages, $parent,$slug;
    public $typePage = 'faq category';
    protected $rules = [

        'parent' => 'required',
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';


            $translations[] = [
                'title' => $title,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function getItems() {
        return [
            'status' => $this->status,
            'parent' => $this->parent,
            'slug' => $this->slug
        ];
    }

    public function saveInfo() {

        $this->validate();
        $translates = $this->getTranslate();
        $items = $this->getItems();
        $data = $this->getInterface()->create($items, $translates);

        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'create ' . $this->typePage,
            'url' => $this->getInterface()->getCurrentTitle($data),
        ]);
        return (redirect(route('admin.helps')))->with('sucsess', 'sucsess');
    }

    public function mount() {
        $this->status = 1;
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {

            $this->title[$value->language->code] = '';
        }
    }

    public function getInterface() {

        return app()->make(IHelp::class);
    }

    public function render() {
        $parents = app()->make(IHelp::class)->get();
        return view('livewire.admin.help.add',compact('parents'))->layout('layouts.admin');
    }

}
