<?php

namespace App\Http\Livewire\Admin\Option;

use Livewire\Component;
use App\Repositories\Contract\{
    ILog,
    IOption
};
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\CreateSettinges;

class Add extends Component {
    use CreateSettinges;

    public $sort, $status, $title, $languages;
    public $typePage = 'package option';
    public $Translateparams  =['title'];
    public $IndexRoute       = 'admin.pack.options';
    public $gate             ='option';
    protected $rules = [
        'sort' => 'required|integer|min:1',
        'status' => 'required|integer|min:0|max:1',
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];


    public function getItems() {
        return [
            'sort' => $this->sort,
            'status' => $this->status,
        ];
    }

    
    public function mount() {
        if (!Gate::allows('show_option')) {
            abort(403);
        }
        $this->status = 1;
        $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(IOption::class);
    }

    public function render() {

        return view('livewire.admin.option.add')->layout('layouts.admin');
    }

}
