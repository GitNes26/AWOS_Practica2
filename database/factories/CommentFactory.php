<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->sentence(4),
        'user_id' => App\Models\User::all()->random()->id,
        'product_id' => App\Models\Product::all()->random()->id
    ];
});
