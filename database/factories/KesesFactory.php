<?php

namespace Database\Factories;

use App\Models\diaks_tanoras;
use App\Models\Tanora;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keses>
 */
class KesesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomdiakora = diaks_tanoras::all()->random(1)->first();
        $tanoraid=$randomdiakora->Tanora_ID;
        $tanora = Tanora::where(['ID' => $tanoraid])->first();
        $kezdet=$tanora->kezdet;
        $veg=$tanora->veg;
        $date1 = strtotime( $kezdet);
        $date2 = strtotime( $veg);
        return [
            "Datum"=>$this->faker->dateTimeBetween($startDate = $tanora->kezdet, $endDate = $tanora->veg),
            "Kesett_perc"=>$this->faker->numberBetween($min=5,$max=(($date2 - $date1) / 60)),
            "Diak_Tanora_ID"=>$tanoraid
        ];
    }
}
