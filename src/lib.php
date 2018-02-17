<?php
/**
 * DIC Configuration
 * Container
 */

use Noodlehaus\Config;
use Aura\Sql\ExtendedPdo;

 // Configuration
$container['config'] = function () {
    return new Config([
        __DIR__ . '/../config/app.php',
        __DIR__ . '/../config/database.php',
        __DIR__ . '/../config/logger.php',
        __DIR__ . '/../config/view.php',
    ]);
};

// Log (monolog)
$container['logger'] = function ($container) {
    $settings = $container['config']->get('logger');
    $logger = new Monolog\Logger('Icarus');
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Database
$container['db'] = function ($container) {
    $settings = $container['config']->get('database');
    return new ExtendedPdo(
        $settings['driver'] . ':dbname=' . $settings['database'] . ';host=' . $settings['host'],
        $settings['username'],
        $settings['password'],
        ['PDO::ATTR_ERRMODE','PDO::ERRMODE_EXCEPTION']
    );
};

// View renderer (twig)
$container['view'] = function ($container) {
    $settings = $container['config']->get('view');
    $debug = $container['config']->get('app.debug');
    $debug ? $config = ['cache' => false] : $config = ['cache' => true, 'cache_path' => $settings['cache_path']];
    $view = new \Slim\Views\Twig($settings['template_path'], $config);
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());
    $view->addExtension(new Knlv\Slim\Views\TwigMessages(new Slim\Flash\Messages()));
    return $view;
};

// Flash message
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// CSRF
$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};

/**
 * Application middleware
 */

// CSRF
$app->add(new \Slim\Csrf\Guard);

// Http authentification
/*
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "users" => [
        "root" => "t00r",
        "somebody" => "passw0rd"
    ]
]));
*/
