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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID', '2141789109461147'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET', '13053f2e39ae647e392d517f56da1464'),
    'redirect' => 'https://www.decoriq.com/login/facebook/callback',
    ],

  'google' => [
  'client_id' => env('GOOGLE_CLIENT_ID', '37989546425-qpf0s4ircmrklh7sn0odgpoth62cegeh.apps.googleusercontent.com'),
  'client_secret' => env('GOOGLE_CLIENT_SECRET', 'Y_dX3zbpvwP6dtMIu60tGgTd'),
  'redirect' => 'https://www.decoriq.com/login/google/callback',
  ],

];
