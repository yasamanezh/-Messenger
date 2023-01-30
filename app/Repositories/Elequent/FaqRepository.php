<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IFaq;
use App\Models\Faq;
use App\Repositories\Elequent\BaseRepository;

class FaqRepository extends BaseRepository implements IFaq {
    
    public function model() {
        
        return Faq::class;        
    }

}
