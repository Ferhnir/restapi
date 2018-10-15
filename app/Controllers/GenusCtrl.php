<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Database\Capsule\Manager as DB;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class GenusCtrl extends Controller {

  protected $tableName = 'genus';
  private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    $this->model = new ApiData();
    $this->model->setTable($this->tableName);

    try {

        $query = DB::table('genus')
                        ->leftJoin('subfamilies','genus.subfamily_id','=','subfamilies.id')
                        ->leftJoin('tribes','genus.tribe_id','=','tribes.id')
                        ->select('genus.id','genus.name',
                                 'subfamilies.id as parent_id','subfamilies.name as parent_name',
                                 'tribes.id as second_parent_id', 'tribes.name as second_parent_name')
                        ->get();

        return $response->withJson([
                                'parentsCount'    => 2,
                                'parentTag'       => 'subfamily',
                                'secondParentTag' => 'tribe',
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
