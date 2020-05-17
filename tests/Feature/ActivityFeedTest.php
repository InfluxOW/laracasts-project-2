<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project_records_acitivity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
    }

    /** @test */
    public function updating_a_project_records_acitivity()
    {
        $project = ProjectFactory::create();
        $project->update(['title' => 'new title']);

        $this->assertCount(2, $project->activity);
    }

    /** @test */
    public function creating_a_new_task_records_project_activity()
    {
        $project = ProjectFactory::create();
        $project->addTask(['body' => 'test body']);

        $this->assertCount(2, $project->activity);
    }

    /** @test */
    public function completing_a_new_task_records_project_activity()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch(
                route('projects.tasks.update', [$project, $project->tasks->first()]),
                ['body' => 'test body', 'completed' => true]
            );

        $this->assertCount(3, $project->activity);
    }
}
