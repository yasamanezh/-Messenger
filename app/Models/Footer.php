<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Footer extends Model {

    use Translations;

    protected $fillable = ['Company_links', 'Support_links', 'Useful_links'];

    use HasFactory;
}
