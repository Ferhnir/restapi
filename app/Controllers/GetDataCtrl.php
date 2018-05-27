<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetDataCtrl extends Controller {

  protected $tableName;
  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    $this->tableName = $request->getAttribute('route')->getArgument('model');

    $this->model = new ApiData();
    $this->model->setTable($this->tableName);

    try {

      $query = $this->model->get();

      return (count($query) == 0) ? 
        $response->withJson($this->ci->db->connection()->getSchemaBuilder()->getColumnListing($this->tableName)) : 
        $response->withJson($query);

    } catch (QueryException $e) {

      return $response->withJson([
        'error' => $e->errorInfo[2]
      ]);

    }
  }  

}

?>
