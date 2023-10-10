<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    protected $message = 'Les informations d\'identification fournies sont incorrectes.';


    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}