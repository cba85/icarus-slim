<?php

/**
 * Slim app
 * Index for Slim app
 */

// Autoload PSR-4
require __DIR__ . '/../vendor/autoload.php';

// Sessions
session_start();

// Load secret parameters (.env)
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

// Instantiate Slim app
$settings = require __DIR__ . '/../config/slim.php';
$app = new \Slim\App($settings);

// Set up dependencies
$container = $app->getContainer();
require __DIR__ . '/../src/dependencies.php';

// Register middlewares
require __DIR__ . '/../src/middlewares.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
