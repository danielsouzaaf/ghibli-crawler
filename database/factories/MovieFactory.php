<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\GhibliCrawler\Models\Movie::class, function (Faker $faker) {
    return [
        'id' => $faker->slug,
        'title' => $faker->title,
        'description' => $faker->paragraphs,
        'director' => $faker->name,
        'producer' => $faker->name,
        'release_date' => $faker->year,
        'rt_score' => $faker->numberBetween(0, 100),
        'url' => $faker->url,
    ];
});