<?php

/** @var Factory $factory */

use App\Models\Status;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create();
        },
        'body' => $faker->paragraph,
    ];
});
