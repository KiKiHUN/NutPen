<?php

namespace Database\Factories;
use App\Models\Diak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\diaks_tanoras>
 */
class diaks_tanorasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "Tanora_ID"=>$this->faker->numberBetween( 1, 30 ),
            "Diak_azonosito"=>Diak::all()->random(1)->first()->azonosito
        ];
    }
}
