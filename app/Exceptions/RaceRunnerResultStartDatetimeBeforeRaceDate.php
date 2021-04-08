<?php
namespace App\Exceptions;

use Exception;

class RaceRunnerResultStartDatetimeBeforeRaceDate extends Exception
{

    /**
     *
     * {@inheritdoc}
     * @see Exception::__construct()
     */
    public function __construct($message = "The race runner result's start time could not be before the race's date", $code = "UE002")
    {}
}
