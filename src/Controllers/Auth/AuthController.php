<?php

namespace App\Controllers\Auth;

use Slim\Http\Request;
use Icarus\Controller as Controller;

/**
 * Controller for authentification
 */
class AuthController extends Controller
{
    /**
     * Signin form
     * @param  Request $request
     * @param  Response $response
     */
    public function signin($request, $response)
    {
        // CSRF
        $data['csrf'] = $this->csrf($request);
        // Flash
        $data['flash'] = $this->flash->getMessages();
        // View
        return $this->renderView($response, 'auth/login.html', $data);
    }

    /**
     * Login
     * @param  Request $request
     * @param  Response $response
     */
    public function login($request, $response) {
        // Get parameters
        $params = $request->getParams();
        // Validation
        // TODO: Validation parameters
        // Login
        $this->auth->attempt($params['email'], $params['password']);
        // Flash message
        $this->flash('Logged');
        // Redirect
        return $response->withStatus(302)->withHeader('Location', '/login');
    }

    /**
     * Logout
     * @param  Request $request
     * @param  Response $response
     */
    public function logout($request, $response) {
        // Logout
        $this->auth->logout();
        // Redirect
        return $response->withStatus(302)->withHeader('Location', '/');
    }
}
