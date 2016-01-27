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
    $admin = \App\Models\Administrator::find(
        $tournament->created_by
    );

    return [
        'tournament_id' => $tournament->id,
        'first_player_id' => 'factory:App\\Models\\Player',
        'second_player_id' => 'factory:App\\Models\\Player',
        'winner' => 'factory:App\\Models\\Player',
        'begin' => $faker->dateTimeBetween(
            'now', '+2 days'
        ),
        'finish' => $faker->dateTimeBetween(
            '+2 days', '+2 days'
        ),
        'created_by' => $admin->id,
    ];
});

$factory('App\\Models\\Ranking', [
    'tournament_id' => 'factory:App\\Models\\Tournament',
    'player_id' => 'factory:App\\Models\\Player',
    'score' => mt_rand(0, 150),
]);
