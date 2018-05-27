<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\ErrorHandler;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

class ApiData extends Model {

    public $timestamps = false;

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function setFillable($fillable)
    {
        $this->fillable = $fillable;
    }

}
?>