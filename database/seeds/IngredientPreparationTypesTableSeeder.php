<?php

use Illuminate\Database\Seeder;
use App\IngredientPreparationType;

class IngredientPreparationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredient_preparation_types')->delete();

        $types = [
            'Chopped',
            'Sliced',
            'Diced',
            'Halved'
        ];

        for($i = 0; $i < count($types); $i++){
            IngredientPreparationType::create(array(
                'id' => $i, 'name' => $types[$i]
            ));
        }
    }
}
