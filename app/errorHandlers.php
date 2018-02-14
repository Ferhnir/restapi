<?php

namespace App;

class ErrorHandler {

  public $errorMsg, $statusCode = '';

  public $errorArr = [];


  public function getErrorMsg($errorNr) {

    switch($errorNr) {

      case '100':
        $this->errorMsg = 'Missing params';
        break;

      case '401':
        $this->errorMsg = 'Login or password is incorrect';
        $this->statusCode = $errorNr;
        break;

      case '1062':
        $this->errorMsg = 'This element already exist';
        break;

      case '4004':
        $this->errorMsg = 'Input name is empty';
        break;

      default:
        $this->errorMsg = 'Unkown error';
        break;
    }

    $this->errorArr = array(
      'error' => true,
      'message' => $this->errorMsg,
      'statusCode' => $this->statusCode,
      'errorCode' => $errorNr
    );

    return $this->errorArr;

  }

}

?>
