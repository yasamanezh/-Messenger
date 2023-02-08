<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
use App\Traits\Model\Translations;
class Pack extends Model
{
    use Translations;
    use HasFactory;
     protected $fillable = ['sort','status','price' ];
       public function options()
    {
        return $this->belongsToMany(Option::class);

    }
        
    
}
