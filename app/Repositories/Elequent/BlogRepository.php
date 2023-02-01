<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\iBlog;
use \App\Models\Blog;
use App\Models\Translate;
use App\Repositories\Elequent\BaseRepository;

class BlogRepository extends BaseRepository implements iBlog {
    
    public function model() {
        return Blog::class;        
    }
    
     public function translationModel() {
        
        return Translate::class;        
    }
    public function hasTranslation() {
        return true;
        
    }
    

}
