<?php

return [
    'source' => [
        'url' => env('MANGA_SOURCE_URL'),
        'endpoint' => env('MANGA_SOURCE_ENDPOINT', 'wp-json/wp/v2/'),
        'headers' => [
            'Referer' => env('MANGA_SOURCE_REFERRER', ''),
            'User-Agent' => env('MANGA_SOURCE_USER_AGENT', ''),
        ],
    ]
];
