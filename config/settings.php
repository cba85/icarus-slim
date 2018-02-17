<?php
/**
 * App settings
 */
return [
    'settings' => [
        // Slim
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        // Renderer settings
        'view' => [
            'template_path' => __DIR__ . '/../app/views/',
            'cache_path' => __DIR__ . '/../storage/cache/',
        ],
        // App
        'app' => [
            'environment' => env('APP_ENV', 'local'),
            'url' => env('APP_URL', 'http://localhost:8080'),
            'debug' => env('APP_DEBUG', true),
        ],
        // Database
        'database' => [
            'driver'    => env('DB_CONNECTION', 'mysql'),
            'host'      => env('DB_HOST', '127.0.0.1'),
            'port'      => env('DB_PORT', '3306'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD'),
            'database'  => env('DB_DATABASE', 'database'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
];
