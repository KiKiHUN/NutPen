<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\jegyek>
 */
class JegyekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $counter = 0;

        $subject_category = [1, 2, 3, 4, 5,];
    
        return [
            'jegy' => $subject_category[$counter++],
        ];
    }
}
