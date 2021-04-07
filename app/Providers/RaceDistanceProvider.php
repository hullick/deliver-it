<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RaceDistanceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Faker', function($app) {
            $faker = \Faker\Factory::create();
            $newClass = new class($faker) extends \Faker\Provider\Base {
                public function raceDistance($distances = ['3','5','10','21','42'])
                {
                    return $distances[$this->generator->numberBetween(0, sizeof($distances) - 1)];
                }
            };
            
            $faker->addProvider($newClass);
            return $faker;
        });
    }
}
