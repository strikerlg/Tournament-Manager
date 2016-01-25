<?php

$factory('App\\Models\\User', [
    'name' => $faker->name,
    'email' => $faker->email,
    'password' => $faker->password,
]);

$factory('App\\Models\\Player', [
    'nickname' => $faker->name,
    'user_id' => 'factory:App\\Models\\User',
]);

$factory('App\\Models\\Administrator', [
    'nickname' => $faker->name,
    'user_id' => 'factory:App\\Models\\User',
]);

$factory('App\\Models\\Game', [
    'name' => $faker->name,
]);

$factory('App\\Models\\Tournament', [
    'name' => $faker->name,
    'begin' => $faker->dateTimeBetween(
        'now', '+ 3 days'
    ),
    'finish' => $faker->dateTimeBetween(
        '+3 days', '+3 days'
    ),
    'has_ended' => false,
    'created_by' => 'factory:App\\Models\\Administrator',
]);

