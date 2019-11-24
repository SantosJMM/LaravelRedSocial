<?php

namespace Tests\Unit\Http\Resources;

use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_user_resources_must_have_the_necessary_fields()
    {
        $user = factory(User::class)->create();
        $userResource = UserResource::make($user)->resolve();

        $this->assertEquals($user->name, $userResource['name']);
        $this->assertEquals($user->avatar(), $userResource['avatar']);
        $this->assertEquals($user->link(), $userResource['link']);
    }
}
