<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\iBlog;
use \App\Models\Blog;
use App\Repositories\Elequent\BaseRepository;

class BlogRepository extends BaseRepository implements iBlog {
    
    public function model() {
        
        return Blog::class;        
    }

}
