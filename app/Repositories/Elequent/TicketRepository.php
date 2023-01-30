<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\ITicket;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

use App\Repositories\Elequent\NoTranslateBaseRepository;

class TicketRepository extends NoTranslateBaseRepository implements ITicket {
    
    public function model() {
        
        return Ticket::class;        
    }
    
    public function createAttach($data,$attachs) {
         DB::beginTransaction();
            $item = $this->getModelClass()->create($data);
            $item->attach()->createMany($attachs);
        DB::commit();

    }

    


}
