<?php
namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Race::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "distance" => app('Faker')->validRaceDistance(),
            "date" => $this->faker->dateTimeBetween("now", "+20years")
        ];
    }
    
    public function withInvalidDistance(){
        return $this->state(function (array $attributes) {
            return [
                'distance' => '7',
            ];
        });
    }
}
