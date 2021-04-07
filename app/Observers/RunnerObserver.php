<?php

namespace App\Observers;

use App\Models\Runner;

class RunnerObserver
{
    /**
     * Handle the Runner "created" event.
     *
     * @param  \App\Models\Runner  $runner
     * @return void
     */
    public function created(Runner $runner)
    {
    }

    /**
     * Handle the Runner "updated" event.
     *
     * @param  \App\Models\Runner  $runner
     * @return void
     */
    public function updated(Runner $runner)
    {
        //
    }

    /**
     * Handle the Runner "deleted" event.
     *
     * @param  \App\Models\Runner  $runner
     * @return void
     */
    public function deleted(Runner $runner)
    {
        //
    }

    /**
     * Handle the Runner "restored" event.
     *
     * @param  \App\Models\Runner  $runner
     * @return void
     */
    public function restored(Runner $runner)
    {
        //
    }

    /**
     * Handle the Runner "force deleted" event.
     *
     * @param  \App\Models\Runner  $runner
     * @return void
     */
    public function forceDeleted(Runner $runner)
    {
        //
    }
}
