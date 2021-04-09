<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RaceRunnerResult;

class RaceRunnerResultSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RaceRunnerResult::factory()->count(30)
            ->withRaceSubscription()
            ->withStartTime()
            ->withFinishTime()
            ->create();
    }
}
