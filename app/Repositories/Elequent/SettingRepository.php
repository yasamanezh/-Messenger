<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\ISetting;
use App\Models\Setting;

use App\Repositories\Elequent\BaseRepository;

class SettingRepository extends BaseRepository implements ISetting {

    public function model() {

        return Setting::class;
    }


}
