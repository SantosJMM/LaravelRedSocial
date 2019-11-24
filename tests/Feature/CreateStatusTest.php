<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function guest_user_can_not_create_statuses()
    {
        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer status']);
        $response->assertRedirect('login');
    }

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
        $response = $this->postJson(route('statuses.store'), ['body' => 'Mi primer status']);
        $response->assertJson([
            'data' => ['body' => 'Mi primer status',]
        ]);

        // 3. Then => Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
        ]);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function a_status_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => '']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function a_status_body_requires_a_minimum_length()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'asdf']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
