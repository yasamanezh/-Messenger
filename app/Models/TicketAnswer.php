<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attach;

class TicketAnswer extends Model {

    use HasFactory;

    protected $fillable = ['ticket_id', 'user_id', 'answer'];

    public function attach() {
        return $this->morphMany(Attach::class, 'attachable');
    }

}
