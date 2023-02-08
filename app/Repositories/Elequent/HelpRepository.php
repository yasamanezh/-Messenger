<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IHelp;
use App\Models\Help;
use App\Models\Translate;
use App\Repositories\Elequent\BaseRepository;

class HelpRepository extends BaseRepository implements IHelp {
    
    public function model() {
        
        return Help::class;        
    }
        public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }
    public function parentsCategory() {
       return $this->getModelClass()->where('status',1)->where('parent',0)->get();
    }
     public function allCategory() {
       return $this->getModelClass()->where('status',1)->where('parent','<>',0)->get();
    }
    
    
    public function childrenCategory($id) {
        return $this->getModelClass()->where('status',1)->where('parent',$id)->get();
    }

}
