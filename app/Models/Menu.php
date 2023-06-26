<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Menu extends Model {

    use HasFactory;
    use Translations;

    protected $fillable = ['slug', 'parent', 'type','sort','status','show_in_header','show_in_footer','link'];

  
    

}
