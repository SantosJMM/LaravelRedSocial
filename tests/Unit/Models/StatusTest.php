<?php

namespace Tests\Unit\Models;

use App\User;
use App\Models\Status;
use App\Models\Comment;
use App\Traits\HasLikes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_status_belongs_to_a_user()
    {
        $status = factory(Status::class)->create();

        $this->assertInstanceOf(User::class, $status->user);
    }

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_status_has_many_comments()
    {
        $this->withoutExceptionHandling();

        $status = factory(Status::class)->create();

        factory(Comment::class)->create(['status_id' => $status->id]);
        $this->assertInstanceOf(Comment::class, $status->comments->first());
    }

    /** @test */
    public function a_status_model_must_use_the_trait_has_likes()
    {
        $this->assertClassUsesTrait(HasLikes::class, Status::class);
    }
}
