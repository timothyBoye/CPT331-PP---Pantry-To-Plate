<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginLink()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->assertPathIs('/login')
                    ->assertSee('Login');
        });
    }

    // Test an invalid user trying to login
    public function testInvalidLoginCredentials(){
        $this->browse(function (Browser $browser){
           $browser->visit('/')
               ->clickLink('Login')
               ->type('email', 'invalidemailaddress@email.com')
               ->type('password', 'doesntmatter')
               ->press('Login')
               ->assertSee('These credentials do not match our records.');
        });
    }
}
