<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Model\Translations;

class Setting extends Model {

    protected $fillable = ['logo', 'icon', 'location', 'daf_lang',
        'mail_parameter','mail_username', 'mail_password','mail_mailer','mail_host','mail_port',
        'mail_encription','address', 'phone1', 'phone2', 'email1', 'email2',
        'app_store_link','google_play_link','free_trial','app_link','payment_url','is_payment'
    ];

    use HasFactory;
    use Translations;
}
