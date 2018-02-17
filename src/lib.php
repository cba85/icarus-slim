<?php
use Noodlehaus\Config;
use App\Classes\Database;

/**
 * DIC Configuration
 * Container
 */

// Database
$container['db'] = function ($container) {
    $config = $container->get('settings')['database'];
    return new Database($config);
};

// View renderer (twig)
$container['view'] = function ($container) {
    $settings = $container->get('settings')['view'];
    $app = $container->get('settings')['app'];
    $app['debug'] ? $config = ['cache' => false] : $config = ['cache' => true, 'cache_path' => $settings['cache_path']];
    $view = new \Slim\Views\Twig($settings['template_path'], $config);
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());
    $view->addExtension(new Knlv\Slim\Views\TwigMessages(
        new Slim\Flash\Messages()
    ));
    return $view;
};

// Flash message
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// CSRF
$container['csrf'] = function ($c) {
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
