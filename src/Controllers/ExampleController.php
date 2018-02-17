<?php

namespace App\Controllers;

use Slim\Http\Request;

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
        // Test database
        //$posts = $this->db->fetchAll('SELECT * FROM posts');
        // Test logger
        $this->log('home');
        // Test view
        return $this->view($response, 'index.html');
    }
}
