<?php

return [

    'paths' => [
        resource_path('views'),
    ],

    // No realpath(): it returns false when the directory does not exist yet
    // (e.g. fresh build), which breaks `php artisan config:cache`.
    'compiled' => env('VIEW_COMPILED_PATH', storage_path('framework/views')),

];
