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

