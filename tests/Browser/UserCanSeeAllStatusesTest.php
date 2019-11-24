<?php

namespace Tests\Browser;

use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UserCanSeeAllStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     * @test
     * @return void
     * @throws Throwable
     */
    public function users_can_see_all_statuses_on_the_homepage()
    {
        $status1 = factory(Status::class)->create(['created_at' => now()->subDays(4)]);
        $status2 = factory(Status::class)->create(['created_at' => now()->subDays(3)]);
        $status3 = factory(Status::class)->create(['created_at' => now()->subDays(2)]);
        $status4 = factory(Status::class)->create(['created_at' => now()->subDays(1)]);
        $statuses = [$status1, $status2, $status3, $status4];

        $this->browse(function (Browser $browser) use ($statuses) {
            $browser->visit('/');

            foreach ($statuses as $status) {
                $browser->assertSee($status->body)
                    ->assertSee($status->user->name)
                    ->assertSee($status->created_at->diffForHumans());
            }
        });
    }
}
