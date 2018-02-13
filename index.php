<?php
require_once './vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

//LOAD SETTINGS
$settings = require_once 'app/config/settings.php';

$app = new \Slim\App($settings);

//config
require_once './app/dependiences.php';

$container["jwt"] = function ($container) {
    return new StdClass;
};

$app->add(new \Slim\Middleware\JwtAuthentication([
    "secret" => $container->get('settings')['token']['secret'],
    "header" => "Bearer",
    "algorithm" => ["HS256"],
    "rules" => [
        new \Slim\Middleware\JwtAuthentication\RequestPathRule([
            "path" => "/api",
            "passthrough" => ["/api/auth"]
        ]),
        new \Slim\Middleware\JwtAuthentication\RequestMethodRule([
            "passthrough" => ["GET","OPTIONS"]
        ])
    ],
    "callback" => function ($arguments) use ($app) {
        $container["jwt"] = $arguments;
    },
    "error" => function ($request, $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]), $container);

 //routes
require_once './app/routes.php';

$app->run();

?>