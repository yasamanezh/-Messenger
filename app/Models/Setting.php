<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Setting extends Model {

    protected $fillable = ['logo', 'icon', 'location', 'daf_lang', 'mail_parameter',
        'mail_username', 'mail_password',
        'address', 'phone1', 'phone2', 'email1', 'email2',
        'app_store_link','google_play_link','free_trial','app_link'
    ];

    use HasFactory;
    use Translations;
}
