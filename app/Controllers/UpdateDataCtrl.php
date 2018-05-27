<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class UpdateDataCtrl extends Controller {

  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    if(!$request->getParams()){
      return $response->withJson([
        "status" => "error",
        "message" => "No data sent, failed to update"
      ]);
    }
    
    $this->model = new ApiData();
    $this->model->setTable($request->getAttribute('route')->getArgument('model'));
    $this->model->setFillable(array_keys($request->getParams()));

    
    try {
      $this->model
        ->where('id',$request->getParam('id'))
        ->update($request->getParams());

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
