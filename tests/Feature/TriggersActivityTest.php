<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TriggersActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activities);
        $this->assertNull($project->activities->first()->changes);
    }

    /** @test */
    public function updating_a_project()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'new title']);

        $this->assertCount(2, $project->activities);

        $activity = $project->activities->last();
        $expectedChanges = [
            'before' => ['title' => $project->oldAttributes['title']],
            'after' => ['title' => 'new title']
        ];
        $this->assertEquals($activity->changes, $expectedChanges);
    }

    /** @test */
    public function creating_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->assertCount(2, $project->activities);
        $activity = $project->activities->last();
        $this->assertInstanceOf(Task::class, $activity->subject);
    }

    /** @test */
    public function deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $project->tasks->first()->delete();

        $this->assertCount(3, $project->activities);
    }

    /** @test */
    public function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch(
                route('projects.tasks.update', [$project, $project->tasks->first()]),
                ['body' => 'test body', 'completed' => true]
            );
        $this->assertCount(4, $project->activities);

        $activity = $project->activities->last();
        $this->assertInstanceOf(Task::class, $activity->subject);
    }

    /** @test */
    public function incompleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch(
                route('projects.tasks.update', [$project, $project->tasks->first()]),
                ['body' => 'test body', 'completed' => true]
            );

        $this->patch(
            route('projects.tasks.update', [$project, $project->tasks->first()]),
            ['body' => 'test body', 'completed' => false]
        );

        $this->assertCount(5, $project->activities);

        $activity = $project->activities->last();
        $this->assertInstanceOf(Task::class, $activity->subject);
    }
}
