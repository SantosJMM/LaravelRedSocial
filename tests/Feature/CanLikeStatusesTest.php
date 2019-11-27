<?php

namespace Tests\Feature;

use App\User;
use App\Models\Status;
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
    public function an_authenticated_user_can_like_and_unlink_statuses()
    {
        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        // test like
        $this->assertCount(0, $status->likes);
        $this->actingAs($user)->postJson(route('statuses.likes.store', $status));
        $this->assertCount(1, $status->fresh()->likes);
        $this->assertDatabaseHas('likes', ['user_id' => $user->id]);
        // unlike
        $this->actingAs($user)->deleteJson(route('statuses.likes.destroy', $status));
        $this->assertCount(0, $status->fresh()->likes);
        $this->assertDatabaseMissing('likes', ['user_id' => $user->id]);
    }
}
