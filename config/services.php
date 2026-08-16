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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'doccario_api' => [
        'url' => env('DOCCARIO_API_URL'),
        'warmup_max_attempts' => env('DOCCARIO_API_WARMUP_MAX_ATTEMPTS', 15),
        'warmup_retry_seconds' => env('DOCCARIO_API_WARMUP_RETRY_SECONDS', 5),
        'warmup_timeout_seconds' => env('DOCCARIO_API_WARMUP_TIMEOUT_SECONDS', 15),
        'awake_check_timeout_seconds' => env('DOCCARIO_API_AWAKE_CHECK_TIMEOUT_SECONDS', 3),
        'health_path' => env('DOCCARIO_API_HEALTH_PATH', ''),
        'request_timeout_seconds' => env('DOCCARIO_API_REQUEST_TIMEOUT_SECONDS', 30),
    ],

];
