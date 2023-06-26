<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IOrder;
use App\Models\Order;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class OrderRepository extends NoTranslateBaseRepository implements IOrder {
    
    public function model() {
        
        return Order::class;        
    }
    public function findOrder($id) {
        return $this->getModelClass()->where('pack_id',$id)->where('user_id',auth()->user()->id)->first();
    }

    


}
