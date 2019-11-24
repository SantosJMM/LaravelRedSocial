<?php

namespace Tests\Feature;

use Hash;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_register()
    {
        $this->withoutExceptionHandling();
        $userData = [
            'name' => 'alex07',
            'first_name' => 'Alex',
            'last_name' => 'Marte',
            'email' => 'alex@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('register'), $userData);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email']
        ]);
        $this->assertTrue(
            Hash::check('password', User::first()->password)
        );
    }
}
