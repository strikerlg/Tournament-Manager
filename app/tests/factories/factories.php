<?php

use Laracasts\TestDummy\Factory;

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
        'now', '+3 days'
    ),
    'finish' => $faker->dateTimeBetween(
        '+3 days', '+3 days'
    ),
    'has_ended' => false,
    'created_by' => 'factory:App\\Models\\Administrator',
]);

$factory('App\\Models\\Match', function($faker) {
    $tournament = Factory::create('App\\Models\\Tournament');
    $admin = $tournament->createdBy;

    return [
        'tournament_id' => $tournament,
        'first_player_id' => 'factory:App\\Models\\Player',
        'second_player_id' => 'factory:App\\Models\\Player',
        'winner' => 'factory:App\\Models\\Player',
        'begin' => $faker->dateTimeBetween(
            'now', '+2 days'
        ),
        'finish' => $faker->dateTimeBetween(
            '+2 days', '+2 days'
        ),
        'created_by' => $admin,
    ];
});

