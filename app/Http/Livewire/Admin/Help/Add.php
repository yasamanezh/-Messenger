<?php

namespace App\Http\Livewire\Admin\Help;

use Livewire\Component;
use App\Repositories\Contract\{
    
    IHelp
};
use App\Traits\Admin\CreateSettinges;
use Illuminate\Support\Facades\Gate;

class Add extends Component {
    use CreateSettinges;

    public $status, $title, $languages, $parent, $slug;
    public $typePage = 'faq category';
    public $Translateparams = ['title'];
    public $IndexRoute = 'admin.helps';
    public $gate = 'faq';
    protected $rules = [
        'parent' => 'required',
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];


    public function getItems() {
        return [
            'status' => $this->status,
            'parent' => $this->parent,
            'slug' => $this->slug
        ];
    }

   
    public function mount() {
        $this->status = 1;
         if (!Gate::allows('show_faq')) {
            abort(403);
        }
        $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(IHelp::class);
    }

    public function render() {
        $parents = app()->make(IHelp::class)->get();
        return view('livewire.admin.help.add', compact('parents'))->layout('layouts.admin');
    }

}
