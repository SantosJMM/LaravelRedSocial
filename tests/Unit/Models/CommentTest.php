<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Like;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_comment_belongs_to_a_user()
    {
        $comment = factory(Comment::class)->create();

        $this->assertInstanceOf(User::class, $comment->user);
    }

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_comment_morph_many_likes()
    {
        $this->withoutExceptionHandling();

        $comment = factory(Comment::class)->create();

        factory(Like::class)->create([
            'likeable_id' => $comment->id,         // 1
            'likeable_type' => get_class($comment) // App\Models\Comment
        ]);

        $this->assertInstanceOf(Like::class, $comment->likes->first());
    }

    /**
     * @test
     */
    public function a_comment_can_be_linked_and_unlike()
    {
        $comment = factory(Comment::class)->create();

        $this->actingAs( factory(User::class)->create() );
        $comment->like();
        $this->assertEquals(1, $comment->likes->count());
        $comment->unlike();
        $this->assertEquals(0, $comment->fresh()->likes->count());
    }

    /**
     * @test
     */
    public function a_comment_can_be_linked_once()
    {
        $comment = factory(Comment::class)->create();

        $this->actingAs(factory(User::class)->create());
        $comment->like();
        $this->assertEquals(1, $comment->fresh()->likes->count());
        $comment->like();
        $this->assertEquals(1, $comment->fresh()->likes->count());
    }

    /**
     * @test
     */
    public function a_comment_knows_if_it_has_been_liked()
    {
        $comment = factory(Comment::class)->create();

        $this->assertFalse($comment->isLiked());
        $this->actingAs(factory(User::class)->create());
        $this->assertFalse($comment->isLiked());
        $comment->like();
        $this->assertTrue($comment->isLiked());
    }

    /**
     * @test
     */
    public function a_comment_knows_how_many_likes_it_has()
    {
        $comment = factory(Comment::class)->create();

        $this->assertEquals(0, $comment->likesCount());
        factory(Like::class, 2)->create([
            'likeable_id' => $comment->id,         // 1
            'likeable_type' => get_class($comment) // App\Models\Status
        ]);
        $this->assertEquals(2, $comment->likesCount());
    }
}
