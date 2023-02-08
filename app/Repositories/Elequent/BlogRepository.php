<?php

namespace App\Repositories\Elequent;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Contract\iBlog;
use \App\Models\{
    Blog,
    Post
};
use App\Models\Translate;
use App\Repositories\Elequent\BaseRepository;

class BlogRepository extends BaseRepository implements iBlog {

    public function model() {
        return Blog::class;
    }

    public function postModel() {
        return Post::class;
    }

    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }

    public function getPost($slug = null) {
        
    }

    public function activePosts($search = null, $slug = null,$paginate) {
        $data = null;
        $this->param = $search;
        $post = [];
        if ($slug) {
            $blog = $this->getModelClass()->where('status', 1)->where('slug', $slug)->first();
            if ($blog) {
                $post = app()->make($this->postModel())->where('status', 1)->where('blog_id', $blog->id);
            }
        } else {
            $blogs = $this->getModelClass()->where('status', 1)->pluck('id');
            if ($blogs) {
                $post = app()->make($this->postModel())->where('status', 1)->whereIn('blog_id', $blogs);
            }
        }
        if ($post) {

            $data = $post->whereHas('translate', function (Builder $query) {
                        $query->where('language_id', $this->currentLanquage())
                                ->where('title', 'LIKE', "%{$this->param}%");
                    })->paginate($paginate);
        }

        return $data;
    }

    public function activePostsGet() {
        $data = null;
        $post = [];
        $blogs = $this->getModelClass()->where('status', 1)->pluck('id');
        if ($blogs) {
            $post = app()->make($this->postModel())->where('status', 1)->whereIn('blog_id', $blogs);
        }
        if ($post) {
            $data = $post->whereHas('translate', function (Builder $query) {
                    $query->where('language_id', $this->currentLanquage());
                    })->latest()->take(3)->get();
        }

        return $data;
    }

}
