<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_projects()
    {
        $project = $this->project();

        $this->get(route('projects.index'))->assertRedirect('login');
        $this->get(route('projects.show', $project))->assertRedirect('login');
        $this->get(route('projects.create'))->assertRedirect('login');
        $this->post(route('projects.store'), $project->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->logIn();

        $attributes = [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph()
        ];

        $this->get(route('projects.create'))->assertOk();

        $this->post(route('projects.store'), $attributes)
            ->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects.index'))->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->logIn();

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->logIn();

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_view_his_projects()
    {
        $project = $this->project();

        $this->actingAs($project->owner)->get(route('projects.show', $project))
            ->assertSee($project['title'])
            ->assertSee($project['description']);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->logIn();

        $project = $this->project();

        $this->get(route('projects.show', $project))->assertForbidden();
    }
}
