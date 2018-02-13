<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class authCtrl {

  public function __construct($table) {

    $this->table = $table;

    echo $table;

  }

  public function auth() {

    echo 'dziala ? ';
  }

}


?>
