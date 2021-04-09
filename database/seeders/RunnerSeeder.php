<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Runner;

class RunnerSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Runner::factory()->hasRaceSubscriptions(30)->create();
    }
}
