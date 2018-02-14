<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\errorHandler;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

class SimpleDataModel extends Model {

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

        if($params['name'] != null) {

          $this->insert($this->parseParams($params));
          return $this->getData();

        } else {

          return ErrorHandler::getErrorMsg(4004);

        }

      } catch (QueryException $e) {

        return ErrorHandler::getErrorMsg($e->errorInfo[1]);

      }

    }

    public function updateData($params) {

      try {

        if($params['name'] != null && $params['id'] != null) {

          $this->where('id', $params['id'])->update($this->parseParams($params));
          return $this->getData();

        } else {

          return ErrorHandler::getErrorMsg(4004);

        }

      } catch (QueryException $e) {

        return ErrorHandler::getErrorMsg($e->errorInfo[1]);

      }

    }

    public function deleteData($params) {

      try {

        if(!empty($params)) {

          $this->whereIn('id', explode(",",$params['ids']))->delete();

          return $this->getData();

        } else {

          return ErrorHandler::getErrorMsg(100);

        }


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
