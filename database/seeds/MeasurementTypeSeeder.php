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

        $measures = array(
            array('name' => '', 'comparable_size' => 100), // Currently used when there is no measure i.e. 1 onion
            array('name' => 'cup', 'comparable_size' => 250),
            array('name' => 'tablespoon', 'comparable_size' => 15),
            array('name' => 'teaspoon', 'comparable_size' => 5),
            array('name' => 'ml', 'comparable_size' => 1),
            array('name' => 'kilogram', 'comparable_size' => 2.2), // 2.2lb
            array('name' => 'gram', 'comparable_size' => 1), // subjective: this only works for water, probably fine
            array('name' => 'ounce', 'comparable_size' => 30), // Ounce/grams conversion issue
            array('name' => 'dash', 'comparable_size' => 1), // Dash == 1/8 tsp
            array('name' => 'splash', 'comparable_size' => 3), // Splash  == 2-3mL
            array('name' => 'slice', 'comparable_size' => ''),
            array('name' => 'can', 'comparable_size' => 350), // 350mL
            array('name' => 'head', 'comparable_size' => ''),
            array('name' => 'bunch', 'comparable_size' => ''),
            array('name' => 'lb', 'comparable_size' => 450),
            array('name' => 'stick', 'comparable_size' => 125), // 1/2 cup
            array('name' => 'pinch', 'comparable_size' => 1), // Pinch == 1/8 tsp
            array('name' => 'litre', 'comparable_size' => 1000), // Pinch == 1/8 tsp

        );

        foreach ($measures as $measure) {
            MeasurementType::create(
                array('name' => $measure['name'],
                      'comparable_size' => $measure['comparable_size'])
            );
        }


    }
}
