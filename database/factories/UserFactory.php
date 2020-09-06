<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->userName,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => 'https://api.adorable.io/avatars/'.rand(0, 1000),
        'description' => $faker->paragraph,
        'banner' => 'https://picsum.photos/id/'.rand(0, 1000).'/700/200',
        'email_verified_at' => now(),
        'password' => '123456', // password'
        'remember_token' => Str::random(10),
    ];
});
