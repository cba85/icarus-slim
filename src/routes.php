<?php
/**
 * Routes for web pages
 */

// Home
$app->get('/', 'App\Controllers\ExampleController:home')->setName('home');
