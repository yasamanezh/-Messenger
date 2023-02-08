<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IFaq;
use App\Models\Faq;
use App\Models\Translate;
use App\Repositories\Elequent\BaseRepository;

class FaqRepository extends BaseRepository implements IFaq {

    public function model() {

        return Faq::class;
    }

    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }
    
    public function getFaqs($id) {
        return $this->getModelClass()->where('status',1)->where('help_id',$id)->get();

    }

}
