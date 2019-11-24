<?php

namespace Tests\Unit\Models;

use App\Models\Like;
use App\Models\Status;
use App\User;
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
    public function a_status_has_many_likes()
    {
        $this->withoutExceptionHandling();

        $status = factory(Status::class)->create();

        factory(Like::class)->create(['status_id' => $status->id]);

        $this->assertInstanceOf(Like::class, $status->likes->first());
    }

    /**
     * @test
     */
    public function a_status_can_be_linked()
    {
        $status = factory(Status::class)->create();

        $this->actingAs( factory(User::class)->create() );

        $status->like();

        $this->assertEquals(1, $status->likes->count());
    }

    /**
     * @test
     */
    public function a_status_can_be_linked_once()
    {
        $status = factory(Status::class)->create();

        $this->actingAs( factory(User::class)->create() );

        $status->like();

        $this->assertEquals(1, $status->likes->count());

        $status->like();

        $this->assertEquals(1, $status->fresh()->likes->count());
    }
}
