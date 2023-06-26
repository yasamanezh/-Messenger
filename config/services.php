<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

/*'recaptcha' => [
        'site_key' => '6LcD1NQkAAAAACaoFylOcZle2q8-hkbjq_SyqkPh',
        'secret_key' => '6LcD1NQkAAAAAE6j2Ja1mfe6nqaHN5H3Dum-Tucq',
        'min_score' => .5,
    ],*/
    
    'recaptcha' => [
        'site_key' => '6Lea19QkAAAAAIjHQ4zLdjnM_1u8HakJS2pqV4rj',
        'secret_key' => '6Lea19QkAAAAAL72B6nlpPKa54Iq4PCHdwx-XAQK',
        'min_score' => .5,
    ],
    
    
    
];
