<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Slim\Http\Response;

/**
 * Base controller
 */
class Controller
{

    /**
     * Container
     * @param ContainerInterface $container
     */
    private $container;

    /**
     * Create a base controller instance
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Get a configuration parameter
     * @param  string $key
     * @return string
     */
    public function config($key = null)
    {
        if ($key) {
            return $this->config->get($key);
        }
        return $this->config->all();
    }

    /**
     * Render a PHP/Twig view
     * @param  Response $response
     * @param  string $filename
     * @param  array $params
     * @return mixed
     */
    public function view($response, $filename, $params = [])
    {
        return $this->container->view->render($response, $filename, $params);
    }

    /**
     * Write in log file
     * @param  string $text
     * @param  string $type
     * @return mixed
     */
    public function log($text, $type = 'info')
    {
        switch ($type) {
            // 100
            case 'debug':
                $log = $this->container->logger->debug($text);
                break;

            // 250
            case 'notice':
                $log = $this->container->logger->notice($text);
                break;

            // 300
            case 'warning':
            $log = $this->container->logger->warning($text);
            break;

            // 400
            case 'error':
            $log = $this->container->logger->error($text);
            break;

            // 550
            case 'alert':
            $log = $this->container->logger->alert($text);
            break;

            // 600
            case 'emergency':
            $log = $this->container->logger->emergency($text);
            break;

            // 200
            case 'info':
            default:
                $log = $this->container->logger->info($text);
                break;
        }
        return $log;
    }

    /**
     * Redirection
     * @param  Response  $response
     * @param  string  $route
     * @param  integer $status
     * @return mixed
     */
    public function redirect($response, $route, $status = 302)
    {
        return $response->withStatus($status)->withHeader('Location', $this->router->pathFor($route));
    }

    /**
     * Flash messages
     * @param  string $message
     * @param  string $type
     * @return mixed
     */
    public function flash($message, $type = "success")
    {
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        return $this->flash->addMessage($type, $message);
    }

    /**
     * Magic function __get
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->container->$name;
    }
}
