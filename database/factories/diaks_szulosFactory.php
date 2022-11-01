<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Diak;
use App\Models\Szulo;
use Illuminate\Support\Facades\DB;
use Event;
use PDO;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\diaks_szulos>
 */
class diaks_szulosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $counter=0;
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $result = DB::select('select * from diaks');
        $result2 = DB::select('select * from szulos');
        $diakazon = $result[$counter]['azonosito'];
        $szuloazon = $result[$counter]['azonosito'];
        $counter++;
        return [
            'Diak_azonosito'=>$diakazon,
            'Szulo_azonosito'=>$szuloazon,
            DB::setFetchMode(PDO::FETCH_CLASS)
        ];
        
    }
}