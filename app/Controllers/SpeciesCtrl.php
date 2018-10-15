<?php

namespace App\Controllers;

use App\Models\ApiData;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Database\Capsule\Manager as DB;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SpeciesCtrl extends Controller {

//   protected $tableName = 'species';
//   private $model;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {

    // $this->model = new ApiData();
    // $this->model->setTable($this->tableName);

    try {

        $query = DB::table('species')
                        ->leftJoin('genus','species.genus_id','=','genus.id')
                        ->select('species.id','species.name',
                                 'genus.id as parent_id','genus.name as parent_name')
                        ->get();

        return $response->withJson([
                            'parentsCount'    => 1,
                            'parentTag'       => 'genus',
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
