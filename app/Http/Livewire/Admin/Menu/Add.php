<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Repositories\Contract\{
    iBlog,
    ILog,
    IPost,
    IMenu,
    IPage
};
use App\Traits\Admin\CreateSettinges;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component {
    use CreateSettinges;

    public $slug, $status, $type, $image, $title, $sort, $languages, $parent,$show_in_header,$show_in_footer;
    public $typePage = 'menus';
    public $Translateparams  =['title'];
    public $IndexRoute       = 'admin.menus';
    public $gate             ='design';
    protected $rules = [
        'type' => 'required',
        'parent' => 'required',
        'status' => 'required|integer|min:0|max:1',
        'sort' => 'required|integer',
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
    ];


    public function getItems() {
        return [
            'slug' => $this->slug,
            'show_in_footer' => $this->show_in_footer,
            'show_in_header' => $this->show_in_header,
            'status' => $this->status,
            'type' => $this->type,
            'sort' => $this->sort,
            'parent' => $this->parent,
        ];
    }

  
    public function mount() {
        $this->status = 1;
        if (!Gate::allows('show_design')) {
            abort(403);
        }
        $this->starterDate($this->Translateparams);
       
    }

    public function getInterface() {

        return app()->make(IMenu::class);
    }

    public function render() {
        $blogs = app()->make(iBlog::class)->get();
        $posts = app()->make(IPost::class)->get();
        $menus = app()->make(IMenu::class)->get();
        $pages = app()->make(Ipage::class)->get();

        return view('livewire.admin.menu.add', compact('blogs', 'posts', 'menus','pages'))->layout('layouts.admin');
    }

}
