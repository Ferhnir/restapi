<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetDataCtrl extends Controller {

  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    $this->model = new ApiData();
    $this->model->setTable($request->getAttribute('route')->getArgument('model'));

    try {
      return $response->withJson($this->model->get());
    } catch (QueryException $e) {
      return $response->withJson([
        'error' => $e->errorInfo[2]
      ]);
    }
  }

}

?>
