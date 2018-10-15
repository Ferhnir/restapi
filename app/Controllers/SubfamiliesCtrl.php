<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Database\Capsule\Manager as DB;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SubfamiliesCtrl extends Controller {

  protected $tableName = 'subfamilies';
  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    $this->model = new ApiData();
    $this->model->setTable($this->tableName);

    try {

        $query = DB::table('subfamilies')
                        ->join('families','subfamilies.family_id','=','families.id')
                        ->select('subfamilies.id','subfamilies.name','families.id as parent_id','families.name as parent_name')
                        ->get();

        return $response->withJson([
                            'parentsCount'    => 1,
                            'parentTag'       => 'family',
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
