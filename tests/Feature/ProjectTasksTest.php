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
    public function a_task_requires_a_body()
    {
        $this->logIn();

        $project = $this->project();
        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post(route('projects.tasks.store', $project), $attributes)->assertSessionHasErrors('body');
    }
}
