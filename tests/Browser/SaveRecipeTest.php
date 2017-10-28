<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class SaveRecipeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSaveRecipe()
    {
        $this->browse(function($first, $second){
            $first->loginAs(User::find(55))
                ->visit('/')
                ->pause(200)
                ->press('FRUIT')
                ->clickLink('Avocado')
                ->pause(1000)
                ->waitFor('.recipe-container')
                ->press('Save')
                ->pause(200)
                ->visit('profile/saved_recipes')
                ->assertSee('Sourdough Bread with Avocado Spread');
        });

    }
}
