<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IComment;
use App\Models\Comment;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class CommentRepository extends NoTranslateBaseRepository implements IComment {
    
    public function model() {
        
        return Comment::class;        
    }
    public function getComment($search,$sortColumnName,$sortDirection,$count_data) {
        return $this->getModelClass()->
        where('content', 'LIKE', "%{$search}%")->
        orWhere('name', 'LIKE', "%{$search}%")->
        orWhere('email', 'LIKE', "%{$search}%")->
        orWhere('website', 'LIKE', "%{$search}%")->
        orWhere('id', $search)->
        orderBy($sortColumnName, $sortDirection)->
        latest()->paginate($count_data);
    }
    
    public function UpdatedCustomeSelectPage($value, $param) {

        if ($value) {
          $mulitiSelect = $this->getModelClass()->
        where('content', 'LIKE', "%{$param[0]}%")->
        orWhere('name', 'LIKE', "%{$param[0]}%")->
        orWhere('email', 'LIKE', "%{$param[0]}%")->
        orWhere('website', 'LIKE', "%{$param[0]}%")->
        orWhere('id', $param[0])->latest()->paginate($param[1])->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $mulitiSelect = [];
        }
        return $mulitiSelect;
    }
    
    public function getAnswer($id) {
        
         return $this->getModelClass()->where('parent_id',$id)->first();
    }
    
}
