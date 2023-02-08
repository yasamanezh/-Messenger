<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IFooter;
use App\Models\Footer;
use App\Models\Translate;
use App\Repositories\Elequent\BaseRepository;

class FooterRepository extends BaseRepository implements IFooter {

    public function model() {

        return Footer::class;
    }

    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }

}
