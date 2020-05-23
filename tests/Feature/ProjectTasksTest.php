<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();
        $data = ['body' => 'Lorem ipsum'];

        $this->actingAs($project->owner)->post(route('projects.tasks.store', $project), $data)
            ->assertRedirect();
        $this->get(route('projects.show', $project))->assertSee($project->tasks->first()->body);
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $data = ['body' => 'updated test task'];

        $this->actingAs($project->owner)
            ->patch(route('projects.tasks.update', [$project, $project->tasks->first()]), $data);
        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $data = ['completed' => true, 'body' => 'test body'];

        $this->actingAs($project->owner)
            ->patch(route('projects.tasks.update', [$project, $project->tasks->first()]), $data);
        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function a_task_can_be_incompleted()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $data = ['completed' => true, 'body' => 'test body'];
        $this->actingAs($project->owner)
            ->patch(route('projects.tasks.update', [$project, $project->tasks->first()]), $data);

        $data = ['completed' => false, 'body' => 'test body'];
        $this->actingAs($project->owner)
            ->patch(route('projects.tasks.update', [$project, $project->tasks->first()]), $data);

        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = ProjectFactory::create();
        $data = ['body' => 'Lorem ipsum'];

        $this->post(route('projects.tasks.store', $project), $data)
            ->assertForbidden();
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();
        $data = ['body' => 'test body for the task', 'completed' => true];

        $this->patch(route('projects.tasks.update', [$project, $project->tasks->first()]), $data)
            ->assertForbidden();
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();
        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post(route('projects.tasks.store', $project), $attributes)
            ->assertSessionHasErrors('body', null, 'project_task');
    }
}
