<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Race;
use App\Models\Runner;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\RaceRunnerResult;
use App\Exceptions\RaceRunnerResultStartDatetimeBeforeRaceDate;
use App\Exceptions\RaceRunnerResultFinishTimeBeforeStartTime;

class RaceRunnerResultTest extends TestCase
{

    // use RefreshDatabase;

    /**
     * Trying to add race runner result's with race's date greater than start time.
     *
     * @return void
     */
    public function test_race_runner_result_start_time_before_race_date()
    {
        $this->expectException(RaceRunnerResultStartDatetimeBeforeRaceDate::class);

        RaceRunnerResult::factory()->startTimeBeforeRaceDate()->make();
    }

    
    /**
     * Trying to add race runner result's with start time greater than finish time.
     *
     * @return void
     */
    public function test_race_runner_result_finish_time_before_start_time()
    {
        $this->expectException(RaceRunnerResultFinishTimeBeforeStartTime::class);
        
        RaceRunnerResult::factory()->finishTimeBeforeStartTime()->make();
    }
}
