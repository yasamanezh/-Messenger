<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\Ipart;
use App\Models\Part;
use App\Repositories\Elequent\BaseRepository;

class PartRepository extends BaseRepository implements Ipart {
    
    public function model() {
        
        return Part::class;        
    }

}
