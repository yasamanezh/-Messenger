<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'ltu_translations';

    protected $casts = [
        'source' => 'boolean',
    ];

    protected $with = [
        'language',
    ];



    public function language()
    {
        return $this->belongsTo(Language::class);
    }

  
}
