<?php
use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3, 5),
        'description' => $faker->paragraphs(rand(1,3), true),
    ];
});
