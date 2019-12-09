<?php

/** @var Factory $factory */

use App\User;
use App\Models\Like;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create();
        }
    ];
});
