<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable=['user_id','ticket_id','answer'];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
     public function attach() {
        return $this->morphMany(Attach::class, 'attacheable');
    }

}
