<?php

namespace Database\Factories;
use App\Models\jegyek;
use App\Models\Diak;
use App\Models\Tanora;
use App\Models\diaks_tanoras;
use App\Models\Tantargy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ertekeles>
 */
class ErtekelesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $randomdiakora = diaks_tanoras::all()->random(1)->first();
        $diakazon=$randomdiakora->Diak_azonosito;
        $tanoraid=$randomdiakora->Tanora_ID;
        $tanora = Tanora::where(['ID' => $tanoraid])->first();
        $tantargyid=$tanora->Tantargy_ID;
        $tanarazon=$tanora->Tanar_azonosito;
        return [
            "Tantargy_ID"=>$tantargyid,
            "Diak_azonosito"=>$diakazon,
            "datum"=>$this->faker->dateTimeBetween($startDate = '2022-09-15 8:00', $endDate = '2023-06-15 19:00'),
            "Tanar_azonosito"=>$tanarazon,
            "jegy"=>jegyek::all()->random(1)->first()->jegy,

        ];

    }
}
