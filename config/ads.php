<?php
return [
    'google_analytics_code' => env('GOOGLE_ANALYTICS_CODE', ''),
    'sidebar' => [
        'ad-client' => env('GOOGLE_AD_CLIENT_SIDEBAR', ''),
        'ad-slot' => env('GOOGLE_AD_SLOT_SIDEBAR', ''),
    ],
    'bottom' => [
        'ad-client' => env('GOOGLE_AD_CLIENT_BOTTOM', ''),
        'ad-slot' => env('GOOGLE_AD_SLOT_BOTTOM', ''),
    ]
];