<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;
use Auth;

class ProjectFactory
{
    protected $tasksCount = 0;
    protected $user;

    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function create()
    {
        $project = factory(Project::class)->create([
            'owner_id' => factory(User::class)
        ]);

        $tasks = factory(Task::class, $this->tasksCount)->make();
        $project->tasks()->saveMany($tasks);

        return $project;
    }
}
