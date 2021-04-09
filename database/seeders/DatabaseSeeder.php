<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Race;
use App\Models\RaceSubscription;
use Illuminate\Database\Eloquent\Collection;
use App\Models\RaceRunnerResult;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([]);

        // Create race with multiple results
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
    }

    /**
     * Create a race runner result in database, base in a collection or single race subscription
     *
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
