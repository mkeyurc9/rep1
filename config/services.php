<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
// 'paypal' => [
//     'client_id' => 'AX6vUWzuI8TbfpxVLDxkJj9wR98Jr69ZyIu5CtLSB8Xh0xVg5Ch3mKLpl5hCw6fAOOtz3S1d1DLhjkHB',
//     'secret' => 'ENyeHS439UEkXIpq7atwGntc_5jWt_-mA_ubKFURKXdqr7fx7n4QWB7S03DRnmFdG-x1pujsCgWQ-9oo'

// ],
    'paypal' => [
    'client_id' => 'AVX82e6y1NbVcQ68-k6kqb4dRW0AlXrRoMaGl_kXdKxkVcU_0PP0p4pQWZjFxB_7ri76PzccU3yq3Aw5',
    'secret' => 'EGSOdqCdA8s-K4QCbEsRI2zABnHd2YkMaRHsuI7LRDX7Wol64v5UD8rIEtR3ade7u0rf8IrjMCtyJWlP'
],
];
