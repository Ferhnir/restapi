<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/hello', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $this->response->withJson('Hola! It works');
  });

?>