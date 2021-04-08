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
        return [];
    }

    public function withRace()
    {
        return $this->state(function (array $attributes) {
            return [
                "race_id" => Race::factory()->create()
            ];
        });
    }

    public function withRunner()
    {
        return $this->state(function (array $attributes) {
            return [
                "runner_id" => Runner::factory()->create()
            ];
        });
    }

    public function withRunnerOfFirstGroup()
    {
        return $this->state(function (array $attributes) {
            return [
                "runner_id" => Runner::factory()->firstGroup()
                    ->create()
            ];
        });
    }

    public function withRunnerOfSecondGroup()
    {
        return $this->state(function (array $attributes) {
            return [
                "runner_id" => Runner::factory()->secondGroup()
                    ->create()
            ];
        });
    }

    public function withRunnerOfThirdGroup()
    {
        return $this->state(function (array $attributes) {
            return [
                "runner_id" => Runner::factory()->thirdGroup()
                    ->create()
            ];
        });
    }

    public function withRunnerOfFourthGroup()
    {
        return $this->state(function (array $attributes) {
            return [
                "runner_id" => Runner::factory()->fourthGroup()
                    ->create()
            ];
        });
    }

    public function withRunnerOfFifthGroup()
    {
        return $this->state(function (array $attributes) {
            return [
                "runner_id" => Runner::factory()->fifthGroup()
                    ->create()
            ];
        });
    }
}
