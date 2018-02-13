<?php
require_once './vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app = new \Slim\App();

$app->get('/hello', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $this->response->withJson('Hola! It works');
  });


$app->run();

?>