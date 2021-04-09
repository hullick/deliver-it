<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RaceSubscription;

class RaceSubscriptionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RaceSubscription::factory()->count(30)
            ->withRace()
            ->withRunner()
            ->create();
    }
}
