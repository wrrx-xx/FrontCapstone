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
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'pusher' => [
        'key' => env('PUSHER_APP_KEY', '10942F2C232D87ABC56E7A7C75867FFB74D082DF5EDBA5BA8EE0D012E5777ACE'),
        'secret' => env('PUSHER_APP_SECRET', '1673980B07E77221E20EE85717E40F5DC0FC63C3DA7EE2B9458C1AAD10E84B37'),
        'app_id' => env('PUSHER_APP_ID', '3c7015a6-8d04-4eab-b1a2-ff75859eb333'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER', 'ap1'),
            'useTLS' => true,
        ],
    ],
];
