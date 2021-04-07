<?php
namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Observers\RaceSubscriptionObserver;
use App\Models\Runner;
use App\Observers\RunnerObserver;
use App\Models\RaceSubscription;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        RaceSubscription::observe(RaceSubscriptionObserver::class);
        Runner::observe(RunnerObserver::class);
    }
}
