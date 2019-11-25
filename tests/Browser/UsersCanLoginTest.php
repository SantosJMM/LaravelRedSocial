<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UsersCanLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     * @test
     * @return void
     * @throws Throwable
     */
    public function registered_users_can_login()
    {
        factory(User::class)->create(['email' => 'test@email.com']);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'test@email.com')
                ->type('password', 'password')
                ->press('@login-btn')
                ->assertPathIs('/')
                ->assertAuthenticated();
        });
    }

    /** @test
     * @throws Throwable
     */
    public function user_cannot_login_with_invalid_information()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', '')
                ->press('@login-btn')
                ->assertPresent('@validation-errors')
            ;
        });
    }
}
