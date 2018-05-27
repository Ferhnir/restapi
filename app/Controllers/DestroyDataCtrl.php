<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use App\Controllers\GetDataCtrl;

class DestroyDataCtrl extends Controller {

  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    if(!$request->getParams()){
      return $response->withJson([
        "status" => "error",
        "message" => "No data sent, failed to delete"
      ]);
    }

    $this->tableName = $request->getAttribute('route')->getArgument('model');

    $this->model = new ApiData();
    $this->model->setTable($this->tableName);

    try {
      
      $this->model
        ->whereIn('id', explode(",",$request->getParam('ids')))
        ->delete();

      $query = $this->model->get();

      return (count($query) == 0) ? 
        $response->withJson($this->ci->db->connection()->getSchemaBuilder()->getColumnListing($this->tableName)) : 
        $response->withJson($query);
      
    } catch (QueryException $e) {
      return $response->withJson([
        'status' => 'error',
        'message' => $e->errorInfo[2]
      ]);
    }
  }

}

?>
