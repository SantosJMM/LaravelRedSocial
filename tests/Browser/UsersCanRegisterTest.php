<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UsersCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test
     * @throws Throwable
     */
    public function user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'alex_07')
                    ->type('first_name', 'Alejandro')
                    ->type('last_name', 'Marte')
                    ->type('email', 'ale@email.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('@register-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated()
            ;
        });
    }

    /** @test
     * @throws Throwable
     */
    public function user_cannot_register_with_invalid_information()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', '')
                ->press('@register-btn')
                ->assertPresent('@validation-errors')
            ;
        });
    }
}
