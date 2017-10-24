<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegisterFailOnNameHavingWhiteSpace()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Register')
                    ->type('name', '  ')
                    ->type('email', 'testRegisterFailOnName@email.com')
                    ->type('password', 'Testing1!')
                    ->type('password_confirmation', 'Testing1!')
                    ->press('Register')
                    ->assertSeeIn('.help-block', 'The name field is required');
        });
    }

    public function testPasswordsDontMatch(){
        $this->browse(function(Browser $browser){
            $browser->visit('/')
                ->clickLink('Register')
                ->type('name', 'Valid name')
                ->type('email', 'testRegisterFailOnName@email.com')
                ->type('password', 'Testing1!')
                ->type('password_confirmation', 'Testing!2')
                ->press('Register')
                ->assertSeeIn('.help-block', 'The password confirmation does not match');
        });
    }
}
