<?php

namespace App\Http\Livewire\Admin\Post;

use App\Repositories\Contract\{
    iBlog,
    ILog,
    IPost
};

use Illuminate\Support\Facades\Gate;
use Livewire\WithFileUploads;
use Livewire\Component;

class Add extends Component {

    use WithFileUploads;

    public $slug, $status, $category, $description, $image, $title, $meta_keyword = [], $meta_title = [], $meta_description = [], $languages;
    public $typePage = 'post';
    protected $rules = [
        'slug'               => 'required|string|min:2|max:199|unique:posts,slug',
        'category'           => 'required|exists:blogs,id',
        'image'              => 'required|image',
        'status'             => 'required|integer|min:0|max:1',
        "description"        => "required|array|min:1",
        "description.en"     => "required|string",
        "title"              => "required|array|min:1",
        "title.en"           => "required|string|min:3",
        "meta_keyword.*"     => "nullable|string|min:3",
        "meta_title.*"       => "nullable|string|min:3",
        "meta_description.*" => "nullable|string|min:3",
    ];

    public function uploadImage() {

        $directory = "public/photos/posts";
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        return("photos/posts/" . "$name");
    }

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {
            $meta_title = '';
            $meta_keyword = '';
            $meta_description = '';

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';

            if ($this->meta_title && $this->meta_title[$lan->language->code]) {
                $meta_title = $this->meta_title[$lan->language->code];
            }
            if ($this->meta_keyword && $this->meta_keyword[$lan->language->code]) {
                $meta_keyword = $this->meta_keyword[$lan->language->code];
            }
            if ($this->meta_description && $this->meta_description[$lan->language->code]) {
                $meta_description = $this->meta_description[$lan->language->code];
            }

            $translations[] = [
                'title' => $title,
                'content' => $content,
                'meta_title' => $meta_title,
                'meta_keyword' => $meta_keyword,
                'meta_description' => $meta_description,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function getItems() {
        return [
            'slug' => $this->slug,
            'status' => $this->status,
            'image' => $this->uploadImage(),
            'blog_id' => $this->category,
        ];
    }

    public function saveInfo() {
        if (Gate::allows('edit_post')) {
            $this->validate();
            $translates = $this->getTranslate();
            $items = $this->getItems();

            $data = $this->getInterface()->create($items, $translates);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'create ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($data),
            ]);
            return (redirect(route('admin.posts')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function mount() {
        if (!Gate::allows('show_post')) {
            abort(403);
        }
        $this->status = 1;
        $this->languages = $this->getInterface()->getLanguage();

        foreach ($this->languages as $value) {

            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
            $this->meta_title[$value->language->code] = '';
            $this->meta_keyword[$value->language->code] = '';
            $this->meta_description[$value->language->code] = '';
        }
    }

    public function getInterface() {

        return app()->make(IPost::class);
    }

    public function render() {
        $categories = app()->make(iBlog::class)->all('')->get();

        return view('livewire.admin.post.add', compact('categories'))->layout('layouts.admin');
    }

}
