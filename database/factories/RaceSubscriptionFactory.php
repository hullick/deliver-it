<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RaceSubscription;
use App\Models\Race;
use App\Models\Runner;

class RaceSubscriptionFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RaceSubscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "race_id" => Race::factory()->create(),
            "runner_id" => Runner::factory()->create()
        ];
    }
}
