<?php
// DIC configuration
use Slim\Container;

$container = $app->getContainer();

// Database connection
$container['db'] = function ($container) {
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  return $capsule;
};

$container['authCtrl'] = function ($c) {
  $controller = new \App\Controllers\AuthCtrl($c);
  return $controller;
};

?>
