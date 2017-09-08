<?php

use Illuminate\Database\Seeder;
use App\MeasurementType;

class MeasurementTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurement_types')->delete();

        $types = [
            'tbsp',
            'tsp',
            'cup',
            'pinch',
            'splash'
        ];

        for($i = 0; $i < count($types); $i++){
            MeasurementType::create(array(
               'id' => $i, 'name' => $types[$i]
            ));
        }
    }
}
