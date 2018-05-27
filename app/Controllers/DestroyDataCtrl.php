<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class DestroyDataCtrl extends Controller {

  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    if(!$request->getParams()){
      return $response->withJson([
        "status" => "error",
        "message" => "No data sent, failed to delete"
      ]);
    }

    $this->model = new ApiData();
    $this->model->setTable($request->getAttribute('route')->getArgument('model'));

    try {
      $this->model
        ->whereIn('id', explode(",",$request->getParam('ids')))
        ->delete();

      return $response->withJson($this->model->get());
    } catch (QueryException $e) {
      return $response->withJson([
        'status' => 'error',
        'message' => $e->errorInfo[2]
      ]);
    }
  }

}

?>
