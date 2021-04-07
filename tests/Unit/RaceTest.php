<?php
namespace Tests\Unit;

use App\Models\Race;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\QueryException;

class RaceTest extends TestCase
{

    // use RefreshDatabase;

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
}
