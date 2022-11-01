<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tantargy>
 */
class TantargyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $counter = 0;

        $subject_category = ["Történelem", "Nelyvtan", "Testnevelés", "Agytorna","Faxomkivan","Slaty","Nincsötletem"];
        $subject_desc = ["Őskövületek tanulmányozása", "J vagy LY", "Foci", "IQ mérés","Faxomkivan","Sóós sándor minőségi órája","Passz"];
        return [
            'nev' => $subject_category[$counter],
            'leiras'=>$subject_desc[$counter++],
            
        ];
    }
}
