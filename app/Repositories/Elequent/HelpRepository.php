<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IHelp;
use App\Models\Help;
use App\Repositories\Elequent\BaseRepository;

class HelpRepository extends BaseRepository implements IHelp {
    
    public function model() {
        
        return Help::class;        
    }

}
