<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GlobalNavTests extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testGlobalNavRoutes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/about')
                    ->assertPathIs('/about')
                    ->visit('/contact')
                    ->assertPathIs('/contact');
        });
    }
}
