<?php

namespace App\Controllers\Auth;

use Slim\Http\Request;
use Icarus\Controller as Controller;

/**
 * Controller for authentification
 */
class RegisterController extends Controller
{
    /**
     * Registration form
     * @param  Request $request
     * @param  Response $response
     */
    public function registration($request, $response)
    {
        // CSRF
        $data['csrf'] = $this->csrf($request);
        // Flash
        $data['flash'] = $this->flash->getMessages();
        // View
        return $this->renderView($response, 'auth/register.html', $data);
    }

    /**
     * Register
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function register($request, $response) {
        // Get parameters
        $params = $request->getParams();
        // Flash message
        $this->flash('Registered');
        // Redirect
        return $response->withStatus(302)->withHeader('Location', '/register');
    }
}
