<?php

namespace Tests\Feature;

use App\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CanLikeCommentStatusesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function guest_user_can_not_likes_comments()
    {
        $comment = factory(Comment::class)->create();
        $response = $this->postJson(route('comments.likes.store', $comment));
        $response->assertStatus(401);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_authenticated_user_can_like_and_unlike_comments()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create();

        // like
        $this->assertCount(0, $comment->likes);
        $this->actingAs($user)->postJson(route('comments.likes.store', $comment));
        $this->assertCount(1, $comment->fresh()->likes);
        $this->assertDatabaseHas('likes', ['user_id' => $user->id]);
        // unlike
        $this->actingAs($user)->deleteJson(route('comments.likes.destroy', $comment));
        $this->assertCount(0, $comment->fresh()->likes);
        $this->assertDatabaseMissing('likes', ['user_id' => $user->id]);
    }
}
