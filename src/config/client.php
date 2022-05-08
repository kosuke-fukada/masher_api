<?php
declare(strict_types=1);

return [
    'api' => [
        'twitter' => [
            'base_url' => env('TWITTER_API_BASE_URL', '')
        ],
        'twitter_oembed' => [
            'base_url' => env('TWITTER_OEMBED_API_BASE_URL', '')
        ]
    ],
    'twitter' => [
        'base_url' => env('TWITTER_BASE_URL', '')
    ]
];
