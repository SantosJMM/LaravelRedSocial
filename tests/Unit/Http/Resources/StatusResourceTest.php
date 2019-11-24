<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_status_resources_must_have_the_necessary_fields()
    {
        $status = factory(Status::class)->create();

        $statsResource = StatusResource::make($status)->resolve();

        $this->assertEquals($status->id, $statsResource['id']);
        $this->assertEquals($status->body, $statsResource['body']);
        $this->assertEquals($status->user->name, $statsResource['user_name']);
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $statsResource['user_avatar']);
        $this->assertEquals($status->created_at->diffForHumans(), $statsResource['ago']);
        $this->assertEquals(false, $statsResource['is_liked']);
        $this->assertEquals(0, $statsResource['likes_count']);
    }
}
