<?php

namespace App\Controllers;

use App\Models\simpleDataModel as insectModel;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SimpleDataCtrl extends Controller {

  public function __construct(Builder $table) {

    $this->table = $table->from;

    $this->model = new insectModel($this->table);

  }

  //
  //GET DATA
  //
  public function getData(ServerRequestInterface $request, ResponseInterface $response) {

    return $response->withJson($this->model->getData());

  }

  public function getAllData(ServerRequestInterface $request, ResponseInterface $response) {

    $obj = "App\Models\_".$this->table.'Model';

    $test = new $obj($this->table);

    return $response->withJson($test->getMergedData());

  }

  //
  //INSERT
  //
  public function setData(ServerRequestInterface $request, ResponseInterface $response) {

    $sth = $this->model->insertData($request->getParsedBody());

    if(array_key_exists('error',$sth)) {

      return $response->withStatus(400)->withJson($sth);

    }

    return $response->withJson($sth);

  }

  //
  //UPDATE
  //
  public function updateData(ServerRequestInterface $request, ResponseInterface $response) {

    $sth = $this->model->updateData($request->getParsedBody());

    if(array_key_exists('error',$sth)) {

      return $response->withStatus(400)->withJson($sth);

    }

    return $response->withJson($sth);

  }

  //
  //DELETE
  //
  public function deleteData(ServerRequestInterface $request, ResponseInterface $response) {

    return $response->withJson($this->model->deleteData($request->getParsedBody()));

  }
}

?>
