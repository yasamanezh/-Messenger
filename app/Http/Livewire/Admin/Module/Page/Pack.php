<?php

namespace App\Http\Livewire\Admin\Module\Page;

use Livewire\Component;
use App\Traits\Admin\UpdateSettinges;
use App\Repositories\Contract\IPage;

class Pack extends Component {

    use UpdateSettinges;


    public $module_id, $title, $languages;
    public $meta_keyword = [],  $meta_description = [];
    public $is_module       = false;
    public $typePage        = 'package page';
    public $Translateparams = ['title','meta_keyword','meta_description'];
    public $IndexRoute      = 'admin.pages';
    public $gate            = 'design';
    
    public function getInterface() {
        return app()->make(IPage::class);
    }
    protected $rules = [

        "title"            => "nullable|array|min:1",
        "title.en"         => "nullable|string|min:3",
        "meta_keyword.en"     => "nullable|string|min:2",
        "meta_description.en" => "nullable|string|min:2",
    ];

    public function getItems() {
        return [ 'slug' => 'pack'];
    }

    public function mount() {
        $data = $this->getInterface()->findBySlug('pack');
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->is_module = true;
            $this->module_id = $data->id;
        }
    }
    public function render() {
        return view('livewire.admin.module.page.pack')->layout('layouts.admin');
    }

}
