<?php
namespace App\Exceptions;

use Exception;

class RunnerTryingToRunARaceInTheSameDayThanAnotherException extends Exception
{

    /**
     *
     * {@inheritdoc}
     * @see Exception::__construct()
     */
    public function __construct($message = "The runner has already a race at the same day than that", $code = "UE001")
    {}
}
