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
                'birthdate' => $this->faker->dateTimeBetween("-17years", "now"),
            ];
        });
    }
    
    /**
     * Set Runner as first group member
     */
    public function firstGroup(){
        return $this->state(function (array $attributes) {
            return [
                'birthdate' => $this->faker->dateTimeBetween("-25years", "-18years"),
            ];
        });
    }
    
    /**
     * Set Runner as second group member
     */
    public function secondGroup(){
        return $this->state(function (array $attributes) {
            return [
                'birthdate' => $this->faker->dateTimeBetween("-35years", "-25years"),
            ];
        });
    }
    
    /**
     * Set Runner as third group member
     */
    public function thirdGroup(){
        return $this->state(function (array $attributes) {
            return [
                'birthdate' => $this->faker->dateTimeBetween("-45years", "-35years"),
            ];
        });
    }
    
    /**
     * Set Runner as fourth group member
     */
    public function fourthGroup(){
        return $this->state(function (array $attributes) {
            return [
                'birthdate' => $this->faker->dateTimeBetween("-55years", "-45years"),
            ];
        });
    }
    
    /**
     * Set Runner as fifth group member
     */
    public function fifthGroup(){
        return $this->state(function (array $attributes) {
            return [
                'birthdate' =>  $this->faker->dateTimeBetween("-100years", "-55years"),
            ];
        });
    }
}
