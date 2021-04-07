<?php
namespace Database\Factories;

use App\Models\Runner;
use Illuminate\Database\Eloquent\Factories\Factory;

class RunnerFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Runner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $birthDate = $this->faker->dateTime("-18years");
        $cpf = $this->faker->cpf(false);
        
        return [
            "name" => $name,
            "cpf" => $cpf,
            "birthdate" => $this->faker->dateTime("-18years"),
        ];
    }
    
    /**
     * Set Runner as underage
     */
    public function underage(){
        return $this->state(function (array $attributes) {
            return [
                'birthdate' => $this->faker->dateTimeBetween("-18years", "now"),
            ];
        });
    }
}
