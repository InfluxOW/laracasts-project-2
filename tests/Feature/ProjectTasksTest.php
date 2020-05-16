<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $project = factory('App\Project')->create();
        $user = $project->owner;

        $data = ['body' => 'Lorem ipsum'];
        $this->actingAs($user)->post(route('projects.tasks.store', $project), $data)
            ->assertRedirect();
        $this->get(route('projects.show', $project))->assertSee($project->tasks->first()->body);
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = $this->project();
        $task = $project->addTask(['body' => 'test task']);

        $data = ['body' => 'updated test task', 'completed' => true];
        $this->actingAs($project->owner)->patch(route('projects.tasks.update', compact('project', 'task')), $data);
        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = $this->project();
        $data = ['body' => 'Lorem ipsum'];

        $this->actingAs(auth()->user())->post(route('projects.tasks.store', $project), $data)
            ->assertForbidden();
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();
        $project = $this->project();
        $task = $project->addTask(['body' => 'Lorem ipsum']);
        $data = ['body' => 'test body for the task', 'completed' => true];

        $this->actingAs(auth()->user())->patch(route('projects.tasks.update', compact('project', 'task')), $data)
            ->assertForbidden();
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = $this->project();
        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post(route('projects.tasks.store', $project), $attributes)->assertSessionHasErrors('body');
    }
}
