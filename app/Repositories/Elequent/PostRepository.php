<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IPost;
use App\Models\Post;
use App\Repositories\Elequent\BaseRepository;

class PostRepository extends BaseRepository implements IPost {
    
    public function model() {
        
        return Post::class;        
    }

}
