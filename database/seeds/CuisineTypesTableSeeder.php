<?php

use Illuminate\Database\Seeder;
use App\CuisineType;

class CuisineTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cuisine_types = array(
            'German', 'French', 'Italian', 'Spanish', 'American', 'Mediterranean','Mexican','Chinese','Japanese','Indian','Thai'
        );

        foreach($cuisine_types as $type){
            CuisineType::create(array(
                'name' => $type
            ));
        }
    }
}
