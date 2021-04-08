<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\RaceRunnerResult;
use App\Exceptions\RaceRunnerResultStartDatetimeBeforeRaceDate;
use App\Exceptions\RaceRunnerResultFinishTimeBeforeStartTime;
use App\Models\RaceSubscription;

class RaceRunnerResultTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Trying to add race runner result's with race's date greater than start time.
     *
     * @return void
     */
    public function test_race_runner_result_start_time_before_race_date()
    {
        $this->expectException(RaceRunnerResultStartDatetimeBeforeRaceDate::class);

        $raceSubscription = RaceSubscription::factory()->withRace()
            ->withRunner()
            ->create();

        RaceRunnerResult::factory()->for($raceSubscription)
            ->startTimeBeforeRaceDate()
            ->make([
            "finish_time" => app('Faker')->dateTimeBetween($raceSubscription->getAttribute("race")
                ->getAttribute("date")
                ->addHour(1), $raceSubscription->getAttribute("race")
                ->getAttribute("date")
                ->addHour(6))
        ]);
    }

    /**
     * Trying to add race runner result's with start time greater than finish time.
     *
     * @group Current
     * @return void
     */
    public function test_race_runner_result_finish_time_before_start_time()
    {
        $this->expectException(RaceRunnerResultFinishTimeBeforeStartTime::class);

        RaceRunnerResult::factory()->for(RaceSubscription::factory()->withRace()
            ->withRunner())
            ->withStartTime()
            ->finishTimeBeforeStartTime()
            ->make();
    }
}
