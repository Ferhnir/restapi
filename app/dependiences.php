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
  $table = $c->get('db')->table('users');
  $controller = new \App\Controllers\AuthCtrl($table);
  return $controller;
};

$container['insectAdult'] = function ($c) {
  $table = $c->get('db')->table('adult');
  $controller = new \App\Controllers\simpleDataCtrl($table);
  return $controller;
};

$container['insectCountries'] = function ($c) {  
  $table = $c->get('db')->table('countries');
  $controller = new \App\Controllers\simpleDataCtrl($table);
  return $controller;
};

$container['insectFood'] = function ($c) {  
  $table = $c->get('db')->table('food');
  $controller = new \App\Controllers\simpleDataCtrl($table);
  return $controller;
};

$container['insectFamilies'] = function ($c) {  
  $table = $c->get('db')->table('families');
  $controller = new \App\Controllers\simpleDataCtrl($table);
  return $controller;
};

$container['insectSubfamilies'] = function ($c) {
  $table = $c->get('db')->table('subfamilies');
  $controller = new \App\Controllers\simpleDataCtrl($table);
  return $controller;
};

?>
