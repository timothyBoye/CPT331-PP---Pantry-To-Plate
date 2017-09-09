<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(IngredientPreparationTypesTableSeeder::class);
        $this->call(MeasurementTypesTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
    }
}
