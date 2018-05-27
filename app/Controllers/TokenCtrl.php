<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Carbon\Carbon;
use \Firebase\JWT\JWT;

class TokenCtrl extends Controller {

    public function generateToken($user, $secret)
    {

        $now = Carbon::now()->timezone('Europe/London');
        $future = Carbon::now()->timezone('Europe/London')->addHour();

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "user"=> $user
        ];

        $token = JWT::encode($payload, $secret, 'HS256');
        
        $response = (object)array(
            "status"  => '1',
            "token"   => $token);

        return $response;
    }

    public function decodeToken($token, $secret)
    {
        $token = JWT::decode($token, $secret, 'HS256');

        return $token;
    }

}