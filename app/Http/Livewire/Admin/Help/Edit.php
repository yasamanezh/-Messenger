<?php

namespace App\Http\Livewire\Admin\Help;

use Livewire\Component;
use App\Traits\Admin\UpdateSettinges;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\IHelp;

class Edit extends Component {

    use UpdateSettinges;

    public $module_id, $status, $title, $languages, $parent, $slug;
    public $typePage = 'faq category';
    public $Translateparams = ['title'];
    public $IndexRoute = 'admin.helps';
    public $gate = 'faq';
    protected $rules = [
        'status' => 'required|integer|min:0|max:1',
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

    public function mount($id) {
        if (!Gate::allows('show_faq')) {
            abort(403);
        }
        $data = $this->getInterface()->find($id);
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->status = $data->status;
            $this->parent = $data->parent;
            $this->slug = $data->slug;
            $this->module_id = $id;
        }
    }

    public function getInterface() {

        return app()->make(IHelp::class);
    }

    public function render() {
        $parents = app()->make(IHelp::class)->get();
        return view('livewire.admin.help.edit', compact('parents'))->layout('layouts.admin');
    }

}
