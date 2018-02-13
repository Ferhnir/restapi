<?php
// DIC configuration
use Slim\Container;

$container = $app->getContainer();

// Database connection
$container['pdo'] = function ($c) {
  $settings = $c->get('settings')['db'];
  $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['database'],
  $settings['username'], $settings['password']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $pdo;
};


?>
