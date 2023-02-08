<?php

namespace App\Http\Livewire\Admin\Package;

use App\Repositories\Contract\{
    IOption,
    ILog,
    IPack
};
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component {

    public $sort, $status, $category, $description, $image, $title, $price, $languages, $options = [];
    public $typePage = 'packages';
    protected $rules = [
        'sort' => 'required|integer|min:1',
        'status' => 'required|integer|min:0|max:1',
        'price' => 'required|integer|min:0',
        "description" => "nullable|array|min:1",
        "description.en" => "nullable|string|min:3",
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
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';


            $translations[] = [
                'title' => $title,
                'content' => $content,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function getItems() {
        return [
            'sort' => $this->sort,
            'status' => $this->status,
            'price' => $this->price,
        ];
    }

    public function saveInfo() {
        if (Gate::allows('edit_pack')) {
            $this->validate();
            $translates = $this->getTranslate();
            $items = $this->getItems();

            $data = $this->getInterface()->create($items, $translates);
            $this->getInterface()->attachOption($data, $this->options);
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'create ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($data),
            ]);
            return (redirect(route('admin.packs')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function mount() {
        if (!Gate::allows('show_pack')) {
            abort(403);
        }
        $this->status = 1;
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
        }
    }

    public function getInterface() {

        return app()->make(IPack::class);
    }

    public function render() {
        $Alloption = app()->make(IOption::class)->get();
        

        return view('livewire.admin.package.add', compact('Alloption'))->layout('layouts.admin');
    }

}
