<?php

$app->add(new \Slim\Csrf\Guard);

// Http authentification
/*
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "users" => [
        "root" => "t00r",
    ]
]));
*/

// Client IP address
/*
$checkProxyHeaders = true;
$trustedProxies = ['10.0.0.1', '10.0.0.2'];
$app->add(new RKA\Middleware\IpAddress($checkProxyHeaders, $trustedProxies));
*/
