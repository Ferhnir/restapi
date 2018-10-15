<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Database\Capsule\Manager as DB;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class TribesCtrl extends Controller {

  protected $tableName = 'tribes';
  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    $this->model = new ApiData();
    $this->model->setTable($this->tableName);

    try {

        $query = DB::table('tribes')
                        ->leftJoin('subfamilies','tribes.subfamily_id','=','subfamilies.id')
                        ->select('tribes.id','tribes.name','tribes.subfamily_id as parent_id','subfamilies.name as parent_name')
                        ->get();

        return $response->withJson([
                            'parentsCount'    => 1,
                            'parentTag'       => 'subfamily',
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
