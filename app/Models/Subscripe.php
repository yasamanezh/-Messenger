<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscripe extends Model {

    protected $fillable = ['user_id','pack_id','pack_title','transaction_id','price','end_at'];

    use HasFactory;

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function packs() {
        return $this->belongsTo(Pack::class);
    }

}
