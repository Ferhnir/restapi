<?php

namespace App\Controllers;

use App\Models\User;

use App\Controllers\TokenCtrl;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthCtrl extends Controller {

  private $logger;

  public function auth(ServerRequestInterface $request, ResponseInterface $response) {

    try {
      $params = $request->getParsedBody();
      if(isset($params['user'], $params['password'])){

        $user = User::query()->where([
          ['name', $params['user']],
          ['password', md5($params['password'])]
        ])->first();

        if($user){
          $token = TokenCtrl::generateToken($user->name, $this->ci['token']['secret']);
          return $response->withJson($token);
        } else {
          return $response->withJson(
            (object)array(
              'status' => 0,
              'error' => 'Invalid login or password'
            ), 401
          );  
        }

      } else {
        return $response->withJson(
          (object)array(
            'status' => 0,
            'error' => 'Missing params, unable to sent login request'
          ), 400
        );
      }
    } catch (QueryException $e) {
      return $response->withJson($e);
    }
    
  }
}

?>
