<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = ['user_id','pack_id','status','price','payload','pack_title','end_at','code'];

    use HasFactory;

  
    
}
