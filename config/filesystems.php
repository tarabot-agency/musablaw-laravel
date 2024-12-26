<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'admins' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/admins',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'pages' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/pages',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'projects' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/projects',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'parteners' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/parteners',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'sliders' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/sliders',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'certificates' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/certificates',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'experiences' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/experiences',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'articles' => [
            'driver' => 'local',
            'root' => base_path() . '/public/images/articles',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'secondary_images'=> [
            'driver' => 'local',
            'root' => base_path() . '/public/images/secondary_images',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        'settings'=> [
            'driver' => 'local',
            'root' => base_path() . '/public/images/settings',
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
