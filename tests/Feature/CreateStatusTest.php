<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_authenticated_user_can_create_statuses()
    {
        $this->withoutExceptionHandling();

        // 1. Given => Teniendo un usario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // 2. When => Cuando hace un pos request a status
        $this->post(route('statuses.store'), ['body' => 'Mi primer status']);

        // 3. Then => Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
        ]);
    }
}
