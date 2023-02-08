<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class ModuleOption extends Model
{
    use Translations;
    protected $fillable = ['image','sort','type','status' ];
    
    use HasFactory; 
}
