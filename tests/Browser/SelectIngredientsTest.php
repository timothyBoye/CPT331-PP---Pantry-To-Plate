<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\CuisineType;
class SelectIngredientsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSelectAvocado()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->press('FRUIT')
                    ->clickLink('Avocado')
                    ->pause(1000)
                    ->waitFor('.recipe-container')
                    ->assertSeeIn('.recipe-name', 'Avocado');
        });
    }

    public function testCuisineFilter(){
        $this->browse(function(Browser $browser){
            $french_id = CuisineType::where('name', '=', 'French')->value('id');
            $japanese_id = CuisineType::where('name', '=', 'Japanese')->value('id');

            $browser->press('VEGETABLE')
                ->clickLink('Pepper')
                ->pause(500)
                ->select('select-cuisine-type-filter', $french_id)
                //->refresh()
                ->pause(500)
                ->waitFor('.recipe-container')
                ->assertSeeIn('.cuisine-ribbon','FRENCH')
                ->assertDontSeeIn('.cuisine-ribbon', 'MEXICAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'WESTERN')
                ->assertDontSeeIn('.cuisine-ribbon', 'INDIAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'MEDITERRANEAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'SPANISH')
                ->assertDontSeeIn('.cuisine-ribbon', 'GERMAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'ITALIAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'CHINESE')
                ->assertDontSeeIn('.cuisine-ribbon', 'JAPANESE')
                ->assertDontSeeIn('.cuisine-ribbon', 'THAI')

                // Japanese
                ->select('select-cuisine-type-filter', $japanese_id)
                ->pause(500)
                ->waitFor('.recipe-container')
                ->assertSeeIn('.cuisine-ribbon', 'JAPANESE')
                ->assertDontSeeIn('.cuisine-ribbon', 'MEXICAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'WESTERN')
                ->assertDontSeeIn('.cuisine-ribbon', 'INDIAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'MEDITERRANEAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'SPANISH')
                ->assertDontSeeIn('.cuisine-ribbon', 'GERMAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'ITALIAN')
                ->assertDontSeeIn('.cuisine-ribbon', 'CHINESE')
                ->assertDontSeeIn('.cuisine-ribbon', 'FRENCH')
                ->assertDontSeeIn('.cuisine-ribbon', 'THAI');
        });
    }
}
