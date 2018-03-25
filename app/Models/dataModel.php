<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\ErrorHandler;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

class dataModel extends Model {

    public $timestamps = false;

    public function __construct($table) {

      $this->table = $table;

    }

    public function getData() {

      try {

        return $this->orderBy('id', 'ASC')->get();

      } catch (QueryException $e) {

        return ErrorHandler::getErrorMsg($e->errorInfo[1]);

      }

    }

    public function insertData($params) {

      try {

        $this->insert($this->parseParams($params));
        return $this->getData();

      } catch (QueryException $e) {

        return ErrorHandler::getErrorMsg($e->errorInfo[1]);

      }

    }

    public function updateData($params) {

      try {

        $this->where('id', $params['id'])->update($this->parseParams($params));
        return $this->getData();

      } catch (QueryException $e) {

        return ErrorHandler::getErrorMsg($e->errorInfo[1]);

      }

    }

    public function deleteData($params) {

      try {

        $this->whereIn('id', explode(",",$params['ids']))->delete();
        return $this->getData();

      } catch (QueryException $e) {

        return ErrorHandler::getErrorMsg($e->errorInfo[1]);

      }

    }

    private function parseParams($params) {

      $newParamArray = [];

      foreach($params as $key => $value) {

        $newParamArray[$key] = $value;

      }

      return $newParamArray;

    }

}

 ?>
