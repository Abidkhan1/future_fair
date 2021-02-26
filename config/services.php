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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
      'client_id' => '407020477020469',
      'client_secret' => '14aafd97d66c41807e9fcc9a9e1d6f82',
      'redirect' => env('APP_URL').'/callback/facebook',
    ],

    'google' => [
        'client_id'     => '888830427204-ajnkk0opsh4q1dfgcugup74j7plg1l16.apps.googleusercontent.com',
        'client_secret' => 'vIw9RimOks4qCaEF-s4OmbAb',
        'redirect'      => env('APP_URL').'/callback',
    ],

];
