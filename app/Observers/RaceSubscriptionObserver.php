<?php
namespace App\Observers;

use App\Models\RaceSubscription;
use App\Exceptions\RunnerTryingToRunARaceInTheSameDayThanAnotherException;

class RaceSubscriptionObserver
{

    /**
     * Check for a runner trying to subscribe in a race that conflict with another.
     *
     * @param RaceSubscription $raceSubscription
     * @return void
     */
    public function creating(RaceSubscription $raceSubscription)
    {
        /** @var $currentRaceSubscription RaceSubscription */
        foreach (RaceSubscription::where("runner_id", $raceSubscription->getAttribute("runner_id"))->get() as $currentRaceSubscription) {
            // Trying to create a subscription for the same day
            if ($raceSubscription->race->date->diffInDays($currentRaceSubscription->race->date) === 0) {
                throw new RunnerTryingToRunARaceInTheSameDayThanAnotherException();
            }
        }
    }
}
