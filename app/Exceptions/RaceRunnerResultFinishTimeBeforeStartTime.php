<?php
namespace App\Exceptions;

use Exception;

class RaceRunnerResultFinishTimeBeforeStartTime extends Exception
{

    /**
     *
     * {@inheritdoc}
     * @see Exception::__construct()
     */
    public function __construct($message = "The race runner result's finish time could not be before the start time", $code = "UE003")
    {}
}
