<?php

namespace App\Models;
//
use Illuminate\Database\Eloquent\Model;
//
use App\ErrorHandler;
//
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

class _subfamiliesModel extends Model {

    public $timestamps = false;

    public function __construct($table) {

      $this->table = $table;

    }

    public function getMergedData() {

      $sth = $this->leftJoin('families', 'families.id', '=', 'subfamilies.family_id')
                         ->select(
                                'subfamilies.id as id',
                                'families.id as family_id',
                                'subfamilies.name as name',
                                'families.name as family_name')
                         ->get();
      return $sth;

    }

  }


 ?>
