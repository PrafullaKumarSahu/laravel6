<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->name;
    return [
        'user_id' => factory(User::class),
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->text
    ];
});
