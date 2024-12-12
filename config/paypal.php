<?php

return [
    'mode' => env('PAYPAL_MODE', 'sandbox'), // Set 'sandbox' or 'live'
    'sandbox' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SECRET'),
        'app_id' => '',
    ],
    'live' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SECRET'),
        'app_id' => '',
    ],
    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency' => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url' => '', // Change this accordingly for your application.
    'locale' => env('PAYPAL_LOCALE', 'en_US'),
    'validate_ssl' => true, // Validate SSL when creating api client.
];
