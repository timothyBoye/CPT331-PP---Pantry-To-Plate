<?php

use Illuminate\Database\Seeder;
use App\NutritionalInfoPanel;

class NutritionalInfoPanelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        NutritionalInfoPanel::create(array('recipe_id'=>1,'gram_total_fat'=>25,'gram_saturated_fat'=>10,'gram_total_carbohydrates'=>58,'gram_sugars'=>12,'gram_fiber'=>6,'mg_sodium'=>1600,'gram_protein'=>35,'calories' => 624));

        NutritionalInfoPanel::create(array('recipe_id'=>2,'gram_total_fat'=>25,'gram_saturated_fat'=>10,'gram_total_carbohydrates'=>58,'gram_sugars'=>12,'gram_fiber'=>6,'mg_sodium'=>1600,'gram_protein'=>35,'calories' => 35));

        NutritionalInfoPanel::create(array('recipe_id'=>3,'gram_total_fat'=>14,'gram_saturated_fat'=>0,'gram_total_carbohydrates'=>86,'gram_sugars'=>78,'gram_fiber'=>0,'mg_sodium'=>0,'gram_protein'=>0,'calories' => 60));

        NutritionalInfoPanel::create(array('recipe_id'=>4,'gram_total_fat'=>25,'gram_saturated_fat'=>10,'gram_total_carbohydrates'=>58,'gram_sugars'=>12,'gram_fiber'=>6,'mg_sodium'=>1600,'gram_protein'=>35,'calories' => 54));

        NutritionalInfoPanel::create(array('recipe_id'=>5,'gram_total_fat'=>null,'gram_saturated_fat'=>null,'gram_total_carbohydrates'=>null,'gram_sugars'=>null,'gram_fiber'=>null,'mg_sodium'=>null,'gram_protein'=>null,'calories' => 224));

        NutritionalInfoPanel::create(array('recipe_id'=>6,'gram_total_fat'=>8,'gram_saturated_fat'=>1,'gram_total_carbohydrates'=>10,'gram_sugars'=>3,'gram_fiber'=>4,'mg_sodium'=>46,'gram_protein'=>2,'calories' => 114));

        NutritionalInfoPanel::create(array('recipe_id'=>7,'gram_total_fat'=>15,'gram_saturated_fat'=>4,'gram_total_carbohydrates'=>33,'gram_sugars'=>1,'gram_fiber'=>5,'mg_sodium'=>317,'gram_protein'=>10,'calories' => 307));

        NutritionalInfoPanel::create(array('recipe_id'=>8,'gram_total_fat'=>86,'gram_saturated_fat'=>19,'gram_total_carbohydrates'=>23,'gram_sugars'=>3,'gram_fiber'=>3,'mg_sodium'=>850,'gram_protein'=>29,'calories' => 980));

        NutritionalInfoPanel::create(array('recipe_id'=>9,'gram_total_fat'=>10,'gram_total_carbohydrates'=>16,'gram_fiber'=>1,'mg_sodium'=>350,'gram_protein'=>10,'calories' => 160));

        NutritionalInfoPanel::create(array('recipe_id'=>10,'gram_total_fat'=>10.9,'gram_saturated_fat'=>null,'gram_total_carbohydrates'=>4,'gram_sugars'=>null,'gram_fiber'=>null,'mg_sodium'=>265,'gram_protein'=>3.7,'calories' => 123));

        NutritionalInfoPanel::create(array('recipe_id'=>11,'gram_total_fat'=>7,'gram_saturated_fat'=>null,'gram_total_carbohydrates'=>1,'gram_sugars'=>null,'gram_fiber'=>0,'mg_sodium'=>212,'gram_protein'=>27,'calories' => 175));
    }
}
