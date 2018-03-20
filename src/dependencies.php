<?php
/**
 * DIC Configuration
 * Container
 */

use Noodlehaus\Config;
use Icarus\Database;
use Icarus\Flash;
use Icarus\Csrf;
use Icarus\Auth;

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
    return new Database($settings);
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
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user()
    ]);
    return $view;
};

// Auth
$container['auth'] = function ($container) {
    return new Auth($container['db']);
};

// Flash message
$container['flash'] = function () {
    return new Flash;
};

// CSRF
$container['csrf'] = function () {
    return new Csrf;
};
