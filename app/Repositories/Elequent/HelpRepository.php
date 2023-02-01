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

}
