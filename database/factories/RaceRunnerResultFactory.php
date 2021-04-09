<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RaceRunnerResult;
use Carbon\Carbon;
use App\Models\RaceSubscription;

class RaceRunnerResultFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RaceRunnerResult::class;

    /**
     * Used to keep an instance between iterations
     *
     * @var \Faker\Factory
     */
    public static $race_subscription = null;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }

    /**
     * State for a race runner result's start time before the race date
     *
     * @return \Database\Factories\RaceRunnerResultFactory
     */
    public function startTimeBeforeRaceDate()
    {
        return $this->state(function (array $attributes) {
            return [
                "start_time" => $this->faker->dateTime(Carbon::parse(RaceSubscription::find($attributes["race_subscription_id"]())->getAttribute("race")
                    ->getAttribute("date")))
            ];
        });
    }

    /**
     * State for a race runner result's finish time before start time
     *
     * @return \Database\Factories\RaceRunnerResultFactory
     */
    public function finishTimeBeforeStartTime()
    {
        return $this->state(function (array $attributes) {
            return [
                "finish_time" => $this->faker->dateTime(Carbon::parse($attributes["start_time"]))
            ];
        });
    }

    public function withRaceSubscription()
    {
        return $this->state(function (array $attributes) {
            return [
                "race_subscription_id" => RaceSubscription::factory()->withRace()
                    ->withRunner()
                    ->create()
            ];
        });
    }

    public function withStartTime()
    {
        return $this->state(function (array $attributes) {
            $raceSubscription = null;
            if ($attributes['race_subscription_id'] instanceof \Closure) {
                $raceSubscription == RaceSubscription::find($attributes['race_subscription_id']());
            } else {
                $raceSubscription = $attributes['race_subscription_id'];
            }

            return [
                "start_time" => $this->faker->dateTimeBetween($raceSubscription->race->getAttribute("date"), $raceSubscription->race->getAttribute("date")
                    ->addHour(1))
            ];
        });
    }

    public function withFinishTime()
    {
        return $this->state(function (array $attributes) {
            return [
                "finish_time" => $this->faker->dateTimeBetween($attributes["start_time"], Carbon::parse($attributes["start_time"])->addHours(5))
            ];
        });
    }
}
