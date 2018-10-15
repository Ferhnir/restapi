<?php
// DIC configuration

$container = $app->getContainer();

// Database connection
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule){
  return $capsule;
};

//Controllers
$container['token'] = function ($c) {
  $token = $c['settings']['token'];
  return $token;
};

$container['AuthCtrl'] = function ($c) {
  return new \App\Controllers\AuthCtrl($c);
};

$container['AdultCtrl'] = function ($c) {
  return new \App\Controllers\AdultCtrl($c);
};

$container['FamiliesCtrl'] = function ($c) {
  return new \App\Controllers\FamiliesCtrl($c);
};

$container['SubfamiliesCtrl'] = function ($c) {
  return new \App\Controllers\SubfamiliesCtrl($c);
};

$container['TribesCtrl'] = function ($c) {
  return new \App\Controllers\TribesCtrl($c);
};

$container['GenusCtrl'] = function ($c) {
  return new \App\Controllers\GenusCtrl($c);
};

$container['SpeciesCtrl'] = function ($c) {
  return new \App\Controllers\SpeciesCtrl($c);
};

$container['CountryCtrl'] = function ($c) {
  return new \App\Controllers\CountryCtrl($c);
};

$container['FoodCtrl'] = function ($c) {
  return new \App\Controllers\FoodCtrl($c);
};

$container['TestCtrl'] = function ($c) {
  return new \App\Controllers\TestCtrl($c);
};


$container['GetDataCtrl'] = function ($c) {
  return new \App\Controllers\GetDataCtrl($c);
};

$container['StoreDataCtrl'] = function ($c) {
  return new \App\Controllers\StoreDataCtrl($c);
};

$container['UpdateDataCtrl'] = function ($c) {
  return new \App\Controllers\UpdateDataCtrl($c);
};

$container['DestroyDataCtrl'] = function ($c) {
  return new \App\Controllers\DestroyDataCtrl($c);
}


?>
