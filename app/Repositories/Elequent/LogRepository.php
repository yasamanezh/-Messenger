<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\ILog;
use App\Models\Log;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class LogRepository extends NoTranslateBaseRepository implements ILog {
    
    public function model() {
        
        return Log::class;        
    }
    

    


}
