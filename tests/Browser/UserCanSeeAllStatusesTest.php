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
        $statuses = factory(Status::class, 3)->create(['body' => 'Hola Como estas']);

        $this->browse(function (Browser $browser) use ($statuses) {
            $browser->visit('/')
                ->waitForText($statuses->first()->body);

            foreach ($statuses as $status) {
                $browser->assertSee($status->body);
            }
        });
    }
}
