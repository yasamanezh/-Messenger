<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\ISubscripe;
use App\Models\Subscripe;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class SubscripeRepository extends NoTranslateBaseRepository implements ISubscripe {
    
    public function model() {
        
        return Subscripe::class;        
    }
    
  public function findSubscripe($id) {
       $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        return $this->getModelClass()->
                where('user_id',auth()->user()->id)
                ->where('pack_id',$id)
                ->where('end_at', '<=', $now)
                ->first();
    }
    


}
