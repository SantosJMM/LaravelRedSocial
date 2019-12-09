<?php

/** @var Factory $factory */

use App\User;
use App\Models\Status;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => function () {
            return factory(User::class)->create();
        },
        'status_id' => function () {
            return factory(Status::class)->create();
        }
    ];
});
