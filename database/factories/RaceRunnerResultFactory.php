<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RaceRunnerResult;
use App\Models\Race;
use App\Models\Runner;
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
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $raceSubscription = RaceSubscription::factory()->create();
        
        $startTime = $this->faker->dateTimeBetween($raceSubscription->getAttribute("race")
            ->getAttribute("date"), $raceSubscription->getAttribute("race")
            ->getAttribute("date")
            ->addHour(1));
        $finishTime = $this->faker->dateTimeBetween(Carbon::parse($startTime), Carbon::parse($startTime)->addHour(5));
        
        return [
            "race_subscription_id" => $raceSubscription->id,
            "start_time" => $startTime,
            "finish_time" => $finishTime
        ];
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
                "start_time" => $this->faker->dateTime(Carbon::parse(RaceSubscription::find($attributes["race_subscription_id"])->getAttribute("race")
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
}
