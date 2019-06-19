<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'content' => $faker->paragraph,
        'author_id' => User::first()->id
    ];
});
