<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Runner;
use App\Exceptions\RunnerUnderAgeException;
use Carbon\Carbon;
use App\Exceptions\RunnerTryingToRunARaceInTheSameDayThanAnotherException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RunnerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing underage user's
     *
     * @group Models
     * @return void
     */
    public function test_underage_user_exception()
    {
        $this->expectException(RunnerUnderAgeException::class);

        Runner::factory()->underage()->make();
    }

    /**
     * @group Models
     * Testing runner's subscription with date conflict
     */
    public function test_race_subscription_conflict()
    {
        $this->expectException(RunnerTryingToRunARaceInTheSameDayThanAnotherException::class);

        Runner::factory()->hasRaceSubscriptions(4, [
            "date" => Carbon::now()
        ])->create();
    }

    // TODO: Test for not unique CPF
}