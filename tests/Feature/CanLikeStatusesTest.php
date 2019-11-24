<?php

namespace Tests\Feature;

use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CanLikeStatusesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function guest_user_can_not_likes_statuses()
    {
        $status = factory(Status::class)->create();
        $response = $this->postJson(route('statuses.likes.store', $status));
        $response->assertStatus(401);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_authenticated_user_can_like_statuses()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $this->actingAs($user)->postJson(route('statuses.likes.store', $status));
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id,
        ]);
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_unlike_statuses()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $this->actingAs($user)->postJson(route('statuses.likes.store', $status));
        $this->actingAs($user)->deleteJson(route('statuses.likes.destroy', $status));
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id,
        ]);
    }
}
