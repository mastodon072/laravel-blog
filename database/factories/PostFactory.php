<?php
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'image_id' => rand(1,10),
        'title' => $faker->sentence(3, 5),
        'content' => $faker->paragraphs(rand(10,15), true),
    ];
});
