<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Firebase\JWT\JWT;
use \Datetime;

class authCtrl {  

  public function __construct($c) {
    
    $this->ci = $c;

  }

  public function auth(ServerRequestInterface $request, ResponseInterface $response, $args) {

    try {
      $req_params = $request->getParsedBody();

      $sth = $this->ci->db->table('users')->get();

      $now = new DateTime();

      $future = new DateTime("now +1 hour");

      $payload = [
          "iat" => $now->getTimeStamp(),
          "exp" => $future->getTimeStamp(),
          "user"=> $req_params['user']
      ];

      $secret = "afromoths1984";

      $token = JWT::encode($payload, $secret, "HS256");
      
      $cccc = [
        "status"  => '1',
        "token"   => $token
      ];

      return $response->withJson($cccc);
    }
    catch (PDOException $e) {
      echo '{"error": {"text": '.$e->getMessage().'}}';
    }
    
  }

}


?>
