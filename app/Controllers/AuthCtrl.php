<?php

namespace App\Controllers;

use App\Models\authModel;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class authCtrl {

  private $logger;

  public function __construct(Builder $table) {

    $this->table = $table->from;

    $this->model = new authModel($this->table);

  }

  public function auth(ServerRequestInterface $request, ResponseInterface $response) {

    $sth = $this->model->authUser($request->getParsedBody());

    if(array_key_exists('error',$sth)) {

      if(array_key_exists('statusCode', $sth)) {

      return $response->withStatus($sth['statusCode'])->withJson($sth);

      } else {

        return $response->withStatus(400)->withJson($sth);

      }

    }

    return $response->withJson($sth);

  }

}

?>
