<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;
use App\Models\Faq;

class Help extends Model
{
    use Translations;
    use HasFactory;
    
    protected $fillable = ['slug', 'parent', 'status'];

    
    
     public function faqs()
    {
      return $this->hasMany(Faq::class);
    }

}
