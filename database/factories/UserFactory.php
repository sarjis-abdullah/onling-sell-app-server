<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
    ];
});

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->text,
        'contact' => $faker->phoneNumber,
        'address' => $faker->address,
        'type' => $faker->country,
        'flatRange' =>  rand(1,4),
        'landRange' =>  rand(1,4),
        'numberOfBed' => rand(1,4),
        'numberOfBath' => rand(1,3),
        'price' =>  rand(1,200),
        'user_id' => rand(1,2),
        'category_id' => rand(1,10),
    ];
});
