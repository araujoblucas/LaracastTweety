<?php

return [

    'default' => env('FILESYSTEM_DRIVER', 'public'),

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],
    'links' => [
        public_path('avatars') => storage_path('app/public/avatars'),
        public_path('banners') => storage_path('app/public/banners'),
        public_path('tweet_image') => storage_path('app/public/tweet_image')
    ],
];
