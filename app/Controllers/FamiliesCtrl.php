<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class FamiliesCtrl extends Controller {

  protected $tableName = 'families';
  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    $this->model = new ApiData();
    $this->model->setTable($this->tableName);

    try {

      $query = $this->model->get();

      // return (count($query) == 0) ? 
      //   $response->withJson($this->ci->db->connection()->getSchemaBuilder()->getColumnListing($this->tableName)) : 
      //   $response->withJson($query);
      
      return $response->withJson([
          'parentsCount'    => 0,
          'categoryList'    => $query
          ]);
    } catch (QueryException $e) {

      return $response->withJson([
        'error' => $e->errorInfo[2]
      ]);

    }
  }  

}

?>
