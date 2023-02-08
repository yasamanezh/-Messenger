<?php

namespace App\Http\Livewire\Admin\Module\Customer\User;

use Livewire\Component;
use App\Repositories\Contract\{IModuleOption};
use App\Traits\Admin\CreateSettinges;
use Livewire\WithFileUploads;

class Add extends Component {
    use WithFileUploads;
    use CreateSettinges;
    public $short_content, $title, $sort, $image, $languages,$name,$job;
    public $typePage = 'clients';
    public $Translateparams  =['title', 'short_content',  ["name","job"]];
    public $IndexRoute       = 'admin.customer.users';
    public $gate             ='design';
    protected $rules = [
        "sort" => "required|integer",
        "short_content" => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3", 
        "name" => "required|array|min:1",
        "name.en" => "required|string|min:3",
    ];

    public function uploadImage() {
        $directory = "public/photos/modules";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }

    public function getItems() {
        return [
            'type' => 'client',
            'sort' => $this->sort,
            'image' => $this->uploadImage(),
        ];
    }

    public function mount() {

        $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(IModuleOption::class);
    }

    public function render() {
        return view('livewire.admin.module.customer.user.add')->layout('layouts.admin');
    }

}
