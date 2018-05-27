<?php 

namespace App\Middleware;

class Middleware {

    protected $ci;

    public function __construct($ci){
        $this->ci = $ci;
    }
    
}