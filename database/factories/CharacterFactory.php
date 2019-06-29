<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\GhibliCrawler\Models\Character::class, function (Faker $faker) {
    return [
        'id' => $faker->slug,
        'name' => $faker->name,
        'gender' => $faker->randomLetter,
        'eye_color' => $faker->colorName,
        'hair_color' => $faker->colorName,
        'age' => $faker->numberBetween(0, 250023)
    ];
});