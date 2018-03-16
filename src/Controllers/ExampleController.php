<?php

namespace App\Controllers;

use Slim\Http\Request;
use Icarus\Controller as Controller;

/**
 * Controller for web pages
 */
class ExampleController extends Controller
{
    /**
     * Homepage
     * @param  Request $request
     * @param  Response $response
     */
    public function home($request, $response)
    {
        $this->log('home');
        return $this->view($response, 'index.html');
    }
}
