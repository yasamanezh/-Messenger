<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;
use App\Models\Help;

class Faq extends Model
{
    use Translations;
    use HasFactory;
        protected $fillable = ['slug', 'status','help_id'];
    
     public function help()
    {
        return $this->beLongsTo(Help::class);
    }
}
