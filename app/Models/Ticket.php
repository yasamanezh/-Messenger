<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Attach,Part,User,Answer};

class Ticket extends Model {

    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'part','status',];

    public function answers() {
        return $this->hasMany(Answer::class, 'ticket_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getPart(){
        return $this->belongsTo(Part::class,'part');
    }

    public function attach() {
        return $this->morphMany(Attach::class, 'attacheable');
    }

}
