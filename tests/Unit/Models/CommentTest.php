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
}
