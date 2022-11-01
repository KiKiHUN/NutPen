<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tanar>
 */
class TanarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $prefix = '$2y$';
        $cost = '10';
        $salt = '$thisisahardcodedsalt$';
        $blowfishPrefix = $prefix.$cost.$salt;
        $password = 'alma';
        $hash = crypt($password, $blowfishPrefix);
        
        return [
            
                "vnev"=> $this->faker->firstName($gender),
                'knev' => $this->faker->lastName(),
                'azonosito'=> $this->faker->bothify('t#?#?#'),
                'jelszo'=>$hash,
                'felh_tipus_ID'=>2
        ];
    }
}
