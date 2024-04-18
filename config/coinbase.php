<?php

return [

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
