<?php

namespace Database\Factories;
use App\Models\Tanar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tanora>
 */
class TanoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = Carbon::createFromTimeStamp($this->faker->dateTimeBetween($startDate = '2022-09-15 8:00', $endDate = '2023-06-15 19:00')->getTimestamp());
        $veg=Carbon::parse($startDate);
        $veg->addHours($this->faker->numberBetween( 1, 4 ));
        return [
           "Tantargy_ID"=>$this->faker->numberBetween( 1, 7 ),
           "kezdet"=>$startDate,
           "veg"=>$veg,
           "Tanar_Azonosito"=>Tanar::all()->random(1)->first()->azonosito
        ];
    }
}
