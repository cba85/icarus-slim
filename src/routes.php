<?php
/**
 * Routes for web pages
 */

// Home
$app->get('/', 'App\Controllers\HomeController:home')->setName('home');
