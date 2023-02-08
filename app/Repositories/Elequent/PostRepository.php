<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IPost;
use App\Models\{Post,Translate,Comment};
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
    
    public function takeEnables($take) {
         return $this->getModelClass()->where('status',1)->latest()->take($take)->get();
    }
    
    public function getCommentModel() {
        return app()->make(Comment::class);
    }
    
    public function comments($id,$paginate) {
        return $this->getCommentModel()->where('status',1)->whereNull('parent_id')->where('post_id',$id)->paginate($paginate);
    }
    
      public function answers($commentid) {
        return $this->getCommentModel()->where('status',1)->where('parent_id',$commentid)->get();
    }
    
    public function related($ids) {
        return $this->getModelClass()->where('status',1)->whereIn('id',$ids)->latest()->get();
    }

}
