<?php

use Illuminate\Database\Seeder;
use App\MeasurementType;

class MeasurementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurement_types')->delete();

        $measures = array(
            array('name' => '', 'comparable_size' => 100), // Currently used when there is no measure i.e. 1 onion
            array('name' => 'cup', 'comparable_size' => 240),
            array('name' => 'tablespoon', 'comparable_size' => 15),
            array('name' => 'teaspoon', 'comparable_size' => 5),
            array('name' => 'ml', 'comparable_size' => 1),
            array('name' => 'gram', 'comparable_size' => 1), // subjective: this only works for water, probably fine
            array('name' => 'ounce', 'comparable_size' => 30), // Ounce/grams conversion issue
            array('name' => 'dash', 'comparable_size' => 0.2), // Dash == 1/8 tsp
            array('name' => 'splash', 'comparable_size' => 0.5), // Splash  == 2-3mL
            array('name' => 'slice', 'comparable_size' => '')
        );

        foreach ($measures as $measure) {
            MeasurementType::create(
                array('name' => $measure['name'],
                      'comparable_size' => $measure['comparable_size'])
            );
        }


    }
}
