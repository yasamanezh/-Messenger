<?php

return [
    'apiKey' => 'fede4bd3-2d83-4940-9731-d18fc058269e',
    'apiVersion' => '2018-03-22',
    'webhookSecret' => 'c2699d53-2fbb-471f-a1d3-404bb2a3b2c3',
    'webhookJobs' => [
         'charge:created' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
         'charge:confirmed' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
         'charge:failed' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
          'charge:delayed' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
        'charge:pending' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
         'charge:resolved' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
    ],
    'webhookModel' => App\Models\CoinbaseWebhookCall::class,
];
