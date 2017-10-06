<?php

use Illuminate\Database\Seeder;
use App\Flavour;
class FlavoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $flavours = [
            'sweet', 'spicy', 'bitter', 'sour'
        ];

        foreach($flavours as $flavour) {
            Flavour::create(array('id' => Config::get('constants.'.$flavour.'_flavour_id'), 'name' => $flavour));
        }
    }
}
