<?php
namespace Tests\Unit;

use App\Models\Race;
use Tests\TestCase;
use Illuminate\Database\QueryException;
use App\Models\RaceRunnerResult;
use App\Models\RaceSubscription;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RaceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_race_distance_invalid()
    {
        $this->expectException(QueryException::class);

        Race::factory()->withInvalidDistance()
            ->make()
            ->save();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_race_runner_results_group()
    {
        $race = Race::factory()->create();

        $this->createRaceRunnerResultOf(RaceSubscription::factory()->withRunnerOfFirstGroup()
            ->count(3)
            ->create([
            "race_id" => $race->id
        ]));

        $this->createRaceRunnerResultOf(RaceSubscription::factory()->withRunnerOfSecondGroup()
            ->count(5)
            ->create([
            "race_id" => $race->id
        ]));

        $this->createRaceRunnerResultOf(RaceSubscription::factory()->withRunnerOfThirdGroup()
            ->count(4)
            ->create([
            "race_id" => $race->id
        ]));

        $this->createRaceRunnerResultOf(RaceSubscription::factory()->withRunnerOfFourthGroup()
            ->count(2)
            ->create([
            "race_id" => $race->id
        ]));

        $this->createRaceRunnerResultOf(RaceSubscription::factory()->withRunnerOfFifthGroup()
            ->create([
            "race_id" => $race->id
        ]));

        $this->assertCount(3, $race->runnersResultsWithRunnersOfFirstGroup, "The amount of inserteds runners of first group was not expected");
        $this->assertCount(5, $race->runnersResultsWithRunnersOfSecondGroup, "The amount of inserteds runners of second group was not expected");
        $this->assertCount(4, $race->runnersResultsWithRunnersOfThirdGroup, "The amount of inserteds runners of third group was not expected");
        $this->assertCount(2, $race->runnersResultsWithRunnersOfFourthGroup, "The amount of inserteds runners of fourth group was not expected");
        $this->assertCount(1, $race->runnersResultsWithRunnersOfFifthGroup, "The amount of inserteds runners of fifth group was not expected");
    }

    /**
     * Create a race runner result in database, base in a collection or single race subscription
     * @param Collection|RaceSubscription $raceSubscriptions
     */
    private function createRaceRunnerResultOf($raceSubscriptions)
    {
        if ($raceSubscriptions instanceof Collection) {
            foreach ($raceSubscriptions as $raceSubscription) {
                RaceRunnerResult::factory()->for($raceSubscription)->create([
                    "start_time" => app('Faker')->dateTimeBetween($raceSubscription->getAttribute("race")
                        ->getAttribute("date"), $raceSubscription->getAttribute("race")
                        ->getAttribute("date")
                        ->addHour(1)),
                    "finish_time" => app('Faker')->dateTimeBetween($raceSubscription->getAttribute("race")
                        ->getAttribute("date")
                        ->addHour(1), $raceSubscription->getAttribute("race")
                        ->getAttribute("date")
                        ->addHour(6))
                ]);
            }
        } else {
            RaceRunnerResult::factory()->for($raceSubscriptions)->create([
                "start_time" => app('Faker')->dateTimeBetween($raceSubscriptions->getAttribute("race")
                    ->getAttribute("date"), $raceSubscriptions->getAttribute("race")
                    ->getAttribute("date")
                    ->addHour(1)),
                "finish_time" => app('Faker')->dateTimeBetween($raceSubscriptions->getAttribute("race")
                    ->getAttribute("date")
                    ->addHour(1), $raceSubscriptions->getAttribute("race")
                    ->getAttribute("date")
                    ->addHour(6))
            ]);
        }
    }
}
