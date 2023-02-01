<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IPost;
use App\Models\{Post,Translate};
use App\Repositories\Elequent\BaseRepository;

class PostRepository extends BaseRepository implements IPost {

    public function model() {

        return Post::class;
    }

    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }

}
