<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\ISocial;
use App\Models\Social;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class SocialRepository extends NoTranslateBaseRepository implements ISocial {

    public function model() {

        return Social::class;
    }


}
