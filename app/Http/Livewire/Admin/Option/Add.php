<?php

namespace App\Http\Livewire\Admin\Option;

use Livewire\Component;
use App\Repositories\Contract\{
    ILog,
    IOption
};
use Illuminate\Support\Facades\Gate;

class Add extends Component {

    public $sort, $status, $title, $languages;
    public $typePage = 'package option';
    protected $rules = [
        'sort' => 'required|integer|min:1',
        'status' => 'required|integer|min:0|max:1',
        "title" => "required|array|min:1",
        "title.*" => "required|string|min:3",
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
            'sort' => $this->sort,
            'status' => $this->status,
        ];
    }

    public function saveInfo() {
        if (Gate::allows('edit_option')) {
            $this->validate();
            $translates = $this->getTranslate();
            $items = $this->getItems();
            $data = $this->getInterface()->create($items, $translates);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'create ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($data),
            ]);
            return (redirect(route('admin.pack.options')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function mount() {
        if (!Gate::allows('show_option')) {
            abort(403);
        }
        $this->status = 1;
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
        }
    }

    public function getInterface() {

        return app()->make(IOption::class);
    }

    public function render() {

        return view('livewire.admin.option.add')->layout('layouts.admin');
    }

}
