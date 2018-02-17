<?php

/**
 * Database settings
 */
return [
    'database' => [
        'driver'    => getenv('DB_CONNECTION', 'mysql'),
        'host'      => getenv('DB_HOST', '127.0.0.1'),
        'port'      => getenv('DB_PORT', '3306'),
        'username'  => getenv('DB_USERNAME', 'root'),
        'password'  => getenv('DB_PASSWORD'),
        'database'  => getenv('DB_DATABASE', 'database'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
];
