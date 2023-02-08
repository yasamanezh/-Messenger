<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{ModuleOption,Attach};
use App\Traits\Model\Translations;

class Module extends Model
{
    use Translations;
    protected $fillable=['file1','fille2','type','meta','more_link'];
    
    use HasFactory;

    public function options()
    {
        return $this->belongsToMany(ModuleOption::class);

    }

    public function attach() {
        return $this->morphMany(Attach::class, 'attacheable');
    }
}
