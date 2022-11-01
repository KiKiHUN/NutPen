<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FelhTipus>
 */
class FelhTipusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $counter = 0;

        $subject_category = ["Diák", "Tanár", "Szülő", "Admin"];
    
        return [
            'tipus' => $subject_category[$counter++],
        ];
    }
}
