<?php
/**
 * Routes for web pages
 */

// Home
$app->get('/', 'App\Controllers\ExampleController:home')->setName('home');

// Auth
$app->get('/register', 'App\Controllers\Auth\RegisterController:registration')->setName('register');
$app->post('/register', 'App\Controllers\Auth\RegisterController:register');
$app->get('/login', 'App\Controllers\Auth\AuthController:signin')->setName('login');
$app->post('/login', 'App\Controllers\Auth\AuthController:login');
$app->post('/logout', 'App\Controllers\Auth\AuthController:logout')->setName('logout');

// Sitemap
$app->get('/sitemap/create', 'App\Controllers\SitemapController:create');
