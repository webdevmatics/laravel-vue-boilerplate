<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'=> $faker->colorName,
        'creator_id'=> User::first()->id
    ];
});
