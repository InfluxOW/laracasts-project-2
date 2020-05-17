<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_project()
    {
        $task = factory(Task::class)->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

    public function it_can_be_completed()
    {
        $task = factory(Task::class)->create();
        $this->assertFalse($task->completed);

        $task->complete();

        $this->assertTrue($task->completed);
    }
}
