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

class Add extends Component {

    public $slug, $status, $type, $image, $title, $sort, $languages, $parent;
    public $typePage = 'menus';
    protected $rules = [
        'type' => 'required',
        'parent' => 'required',
        'status' => 'required|integer|min:0|max:1',
        'sort' => 'required|integer',
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
            'slug' => $this->slug,
            'status' => $this->status,
            'type' => $this->type,
            'sort' => $this->sort,
            'parent' => $this->parent,
        ];
    }

    public function saveInfo() {

        $this->validate();

        if ($this->type == 'blog' || $this->type == 'post') {
            $this->validate([
                'slug' => 'required',
            ]);
        }
        $translates = $this->getTranslate();
        $items = $this->getItems();

        $data = $this->getInterface()->create($items, $translates);

        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'create ' . $this->typePage,
            'url' => $this->getInterface()->getCurrentTitle($data),
        ]);
        return (redirect(route('admin.menus')))->with('sucsess', 'sucsess');
    }

    public function mount() {
        $this->status = 1;
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
        }
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
