<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IOption;
use App\Models\{
    Option,
    Translate
};
use App\Repositories\Elequent\BaseRepository;

class OptionRepository extends BaseRepository implements IOption {

    public function model() {

        return Option::class;
    }

    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }

}
