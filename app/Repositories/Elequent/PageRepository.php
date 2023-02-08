<?php

namespace App\Repositories\Elequent;

use App\Models\Page;
use App\Models\Translate;
use App\Repositories\Elequent\BaseRepository;
use App\Repositories\Contract\IPage;

class PageRepository extends BaseRepository implements IPage {

    public function model() {
        return Page::class;
    }


    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }
    
       public function findBySlugEnable($slug) {
        
       return $this->getModelClass()->with('translate')->where('slug',$slug)->where('status',1)->first();
    }
    

}
