<?php

return [

    'github' => [
        'token' => env('GITHUB_TOKEN'),
        'files' => env('GITHUB_FILES'),
        'hook_secret' => env('GITHUB_HOOK_SECRET'),
        'username' => env('GITHUB_USERNAME'),
    ],

    'last-fm' => [
        'api_key' => env('LAST_FM_API_KEY'),
        'users' => explode(',', env('LAST_FM_USERS')),
    ],

    'packagist' => [
        'vendor' => env('PACKAGIST_VENDOR'),
    ],

    'feedback' => [
        'url' => env('FEEDBACK_JSON_URL'),
    ],

    'game-of-tests' => [
        'base_url' => env('GAME_OF_TESTS_BASE_URL'),
    ],

    'fussbally' => [
        'url' => env('FUSSBALLY_STATS_URL'),
    ]
];
