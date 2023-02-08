<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Page extends Model {

    use Translations;
    use HasFactory;

    protected $fillable = ['slug', 'status','use_app_module'];

    use HasFactory;
}
