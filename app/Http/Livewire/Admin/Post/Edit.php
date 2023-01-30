<?php

namespace App\Http\Livewire\Admin\Post;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Repositories\Contract\{
    ILog,
    IPost,
    iBlog
};

class Edit extends Component {

    public $post_id, $slug, $description, $uploadImage, $img, $status, $title, $meta_keyword, $meta_title, $meta_description, $languages;
    public $typePage = 'posts';
    protected $rules = [
        'category'           => 'required|exists:blogs,id',
        'status'             => 'required|integer|min:0|max:1',
        "description"        => "required|array|min:1",
        "description.en"     => "required|string|min:3",
        "title"              => "required|array|min:1",
        "title.en"           => "required|string|min:3",
        "meta_keyword.*"     => "nullable|string|min:3",
        "meta_title.*"       => "nullable|string|min:3",
        "meta_description.*" => "nullable|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function uploadImage() {
        $directory = "public/photos/posts";
        $name = $this->uploadImage->getClientOriginalName();
        $this->uploadImage->storeAs($directory, $name);
        return("photos/posts/" . "$name");
    }

    public function getCurrentTitle() {

        return $this->getInterface()->getCurrentTitle($this->post_id);
    }

    public function getItems() {
        if ($this->uploadImage) {
            return [
                'slug' => $this->slug,
                'status' => $this->status,
                'image' => $this->uploadImage(),
                'blog_id' => $this->category,
            ];
        } else {
            return [
                'slug' => $this->slug,
                'status' => $this->status,
                'blog_id' => $this->category,
            ];
        }
    }

    public function mount($id) {
    if (!Gate::allows('show_post')) {
            abort(403);
        }
        $data = $this->getInterface()->find($id);


        $this->languages = $this->getInterface()->getLanguage();
        $this->status = $data->status;
        $this->post_id = $id;
        $this->slug = $data->slug;
        $this->image = $data->image;
        $this->category = $data->blog_id;


        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
            $this->meta_title[$value->language->code] = '';
            $this->meta_keyword[$value->language->code] = '';
            $this->meta_description[$value->language->code] = '';
            $code = $data->translate()->where('language_id', $value->language->id)->first();
            if ($code) {
                $this->title[$value->language->code] = $code->title;
                $this->description[$value->language->code] = $code->content;
                $this->meta_title[$value->language->code] = $code->meta_title;
                $this->meta_keyword[$value->language->code] = $code->meta_keyword;
                $this->meta_description[$value->language->code] = $code->meta_description;
            }
        }
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

    public function saveInfo() {
        if (Gate::allows('edit_post')) {
            $this->validate();
            $this->validate([
                'slug' => ['required', 'string', Rule::unique('posts')->ignore($this->post_id)],
            ]);
            if ($this->uploadImage) {
                $this->validate([
                    'uploadImage' => 'required|image',
                ]);
            }
            $translates = $this->getTranslate();
            $items = $this->getItems();

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit ' . $this->typePage,
                'url' => $this->getInterface()->getCurrentTitle($this->post_id),
            ]);

            $this->getInterface()->update($this->post_id, $items, $translates);
            return (redirect(route('admin.posts')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function getInterface() {

        return app()->make(IPost::class);
    }

    public function render() {
        $categories = app()->make(iBlog::class)->get();
        return view('livewire.admin.post.edit', compact('categories'))->layout('layouts.admin');
    }

}
