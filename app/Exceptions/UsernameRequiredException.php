<?php

namespace App\Exceptions;

use Exception;

class UsernameRequiredException extends Exception
{
    protected $message = 'Le nom d\'utilisateur est requis';

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}