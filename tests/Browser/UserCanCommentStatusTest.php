<?php

namespace Tests\Browser;

use App\Models\Comment;
use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UserCanCommentStatusTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws Throwable
     */
    public function users_can_see_all_comments()
    {
        $status = factory(Status::class)->create();
        $comments = factory(Comment::class, 2)->create(['status_id' => $status->id]);

        $this->browse(function (Browser $browser) use ($comments, $status) {
            $browser->visit('/')
                ->waitForText($status->body)
                ->assertSee($comments->shift()->body)
                ->assertSee($comments->shift()->body);
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     * @throws Throwable
     */
    public function authenticated_user_can_comment_statuses()
    {
        $status = factory(Status::class)->create();
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user, $status) {
            $comment = 'Mi primer comentario';

            $browser->loginAs($user)
                ->visit('/')
                ->waitForText($status->body)
                ->type('comment', $comment)
                ->press('@comment-btn')
                ->waitForText($comment)
                ->assertSee($comment);
        });
    }
}
