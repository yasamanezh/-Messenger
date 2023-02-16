<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Language extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'ltu_languages';

    public $timestamps = false;

    public function translation()
    {
        return $this->hasOne(Translation::class);
    }

}
