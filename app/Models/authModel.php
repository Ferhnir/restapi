<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\ErrorHandler;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use \Datetime;
use \Firebase\JWT\JWT;

class authModel extends Model {

    public $timestamps = false;

    public function __construct($table) {

      $this->table = $table;

    }

    public function authUser($params) {

      try {

        if($params['user'] != null && $params['password'] != null) {

           if(count($this->where('name', $params['user'])->where('password', md5($params['password']))->first()) > 0) {

             return $this->createAuthCode($params['user']);

           } else {

             return ErrorHandler::getErrorMsg(401);

           }


        } else {

          return ErrorHandler::getErrorMsg(4004);

        }

      } catch (QueryException $e) {

        return ErrorHandler::getErrorMsg($e->errorInfo[1]);

      }

    }

    private function createAuthCode($user) {

      $now = new DateTime();

      $future = new DateTime("now +1 hour");

      $payload = [
          "iat" => $now->getTimeStamp(),
          "exp" => $future->getTimeStamp(),
          "user"=> $user
      ];

      $secret = "afromoths1984";

      $token = JWT::encode($payload, $secret, "HS256");
      
      $response = [
        "status"  => '1',
        "token"   => $token
      ];

      return $response;

    }
}

 ?>
