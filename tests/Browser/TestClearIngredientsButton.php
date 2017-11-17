<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TestClearIngredientsButton extends DuskTestCase
{

    public function testClearAllSelectedIngredientsButtonWorks()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->press('FRUIT')
                ->clickLink('Avocado')
                ->pause(200)
                ->press('VEGETABLE')
                ->clickLink('Broccoli')
                ->pause(200)
                ->press('DAIRY')
                ->clickLink('Butter')
                ->pause(200)
                ->press('Clear All Selected Ingredients')
                ->assertPlainCookieValue('selectedIngredients', '[]');
        });
    }
}
