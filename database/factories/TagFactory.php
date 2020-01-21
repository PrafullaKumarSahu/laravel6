<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    $title = $faker->word;
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->text
    ];
});
