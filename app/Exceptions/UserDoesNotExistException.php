<?php

namespace App\Exceptions;

use Exception;

class UserDoesNotExistException extends Exception
{
    protected $message = 'L\'utilisateur n\'existe pas dans notre système.';


    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}