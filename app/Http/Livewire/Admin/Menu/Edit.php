<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Repositories\Contract\{
    iBlog,
    ILog,
    IPost,
    IMenu,
    IPage
};
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\UpdateSettinges;

class Edit extends Component {

    use UpdateSettinges;

    public $module_id, $slug, $status, $type, $image, $title, $sort, $languages, $parent,$show_in_footer,$show_in_header;
    public $typePage = 'menus';
    public $Translateparams = ['title'];
    public $IndexRoute = 'admin.menus';
    public $gate = 'design';
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

    public function mount($id) {
        if (!Gate::allows('show_design')) {
            abort(403);
        }
        $data = $this->getInterface()->find($id);
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->status = $data->status;
            $this->show_in_footer = $data->show_in_footer;
            $this->show_in_header= $data->show_in_header;
            $this->module_id = $id;
            $this->slug = $data->slug;
            $this->type = $data->type;
            $this->sort = $data->sort;
            $this->parent = $data->parent;
        }
       
    }

    public function getInterface() {

        return app()->make(IMenu::class);
    }

    public function render() {
        $blogs = app()->make(IBlog::class)->get();
        $posts = app()->make(IPost::class)->get();
        $menus = app()->make(IMenu::class)->get();
        $pages = app()->make(Ipage::class)->get();


        return view('livewire.admin.menu.edit', compact('blogs', 'posts', 'menus', 'pages'))->layout('layouts.admin');
    }

}
