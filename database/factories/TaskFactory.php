<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(3),
        'project_id' => factory(Project::class),
        'completed' => false
    ];
});
