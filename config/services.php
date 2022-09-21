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

    'cloudmailin' => [
        'host' => env('CLOUDMAILIN_HOST'),
        'port' => env('CLOUDMAILIN_PORT'),
        'username' => env('CLOUDMAILIN_USERNAME'),
        'password' => env('CLOUDMAILIN_PASSWORD'),
        'smtp_url' => env('CLOUDMAILIN_SMTP_URL'),
        'authentication' => 'plain',
    ],

    // TODO setup mailgun
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    // TODO setup postmark
    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'sentry' => [
        'laravel_dsn' => env('SENTRY_LARAVEL_DSN'),
        'traces_sample_rate' => env('SENTRY_TRACES_SAMPLE_RATE'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN'),
        'number' => env('TWILIO_NUMBER'),
    ],

];
