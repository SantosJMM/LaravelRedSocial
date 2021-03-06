<?php

/** @var Factory $factory */

use App\User;
use App\Models\Friendship;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Friendship::class, function (Faker $faker) {
    return [
        'recipient_id' => function () {
            return factory(User::class)->create();
        },
        'sender_id' => function () {
            return factory(User::class)->create();
        }
    ];
});
