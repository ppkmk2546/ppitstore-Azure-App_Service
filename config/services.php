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

    'stripe' => [
        'key'   => env('pk_test_51KW7gAHtFtVFXvfMEX1uObxpPbgvrqzTncZ85lf7Y487eUEcc3FZfwQbA2HvB5NzsaOXWVEL979WnVF84gTa3O5100BCCpatue'),
        'secret' => env('sk_test_51KW7gAHtFtVFXvfME8ZxDUaeNRP37tDS9aY2Tj3UiaczjAxaBIsEJxFK0WDhNa2iroAnmia7DjPdXIIKsAJvQNnm00j5xER7rn'),
    ],

];
