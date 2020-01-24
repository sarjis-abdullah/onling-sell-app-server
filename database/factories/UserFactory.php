<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

//$factory->define(User::class, function (Faker $faker) {
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'email_verified_at' => now(),
//        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//        'remember_token' => Str::random(10),
//    ];
//});
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
