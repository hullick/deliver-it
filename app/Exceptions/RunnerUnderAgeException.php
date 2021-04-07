<?php
namespace App\Exceptions;

use Exception;

class RunnerUnderAgeException extends Exception
{

    /**
     * Throwed when a underaged user tries to run in a race.
     * {@inheritdoc}
     * @see Exception::__construct()
     */
    public function __construct($message = "The runner could not be underage", $code = "UE000")
    {}
}
