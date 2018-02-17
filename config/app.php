<?php

/**
 * App settings
 */
return [
    'app' => [
        'name' => getenv('APP_NAME', 'icarus-slim'),
        'environment' => getenv('APP_ENV', 'local'),
        'url' => getenv('APP_URL', 'http://localhost:8080'),
        'debug' => getenv('APP_DEBUG', true),
    ],
];
