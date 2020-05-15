<?php

namespace Tests\Unit;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $project = $this->project();

        $this->assertInstanceOf('App\User', $project->owner);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $project = $this->project();
        $task = Task::make(['body' => 'test task']);
        $project->addTask($task);
        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }
}
