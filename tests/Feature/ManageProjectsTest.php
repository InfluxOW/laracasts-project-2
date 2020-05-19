<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
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
        $project = ProjectFactory::create();

        $this->get(route('projects.index'))->assertRedirect('login');
        $this->get(route('projects.show', $project))->assertRedirect('login');
        $this->patch(route('projects.update', $project), ['title' => 'new title'])->assertRedirect('login');
        $this->get(route('projects.edit', $project))->assertRedirect('login');
        $this->get(route('projects.create'))->assertRedirect('login');
        $this->post(route('projects.store'), $project->toArray())->assertRedirect('login');
        $this->delete(route('projects.destroy', $project))->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $attributes = [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(1),
            'notes' => $this->faker->sentence(4)
        ];

        $this->get(route('projects.create'))->assertOk();

        $response = $this->post(route('projects.store'), $attributes);
        $project = Project::where($attributes)->first();
        $response->assertRedirect(route('projects.show', $project));

        $this->get(route('projects.show', $project))
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_see_all_projects_he_was_invited_to()
    {
        $user = $this->user();
        $project = ProjectFactory::create();
        $project->invite($user);

        $this->actingAs($user)->get(route('projects.index'))->assertSee($project->title);
    }

    /** @test */
    public function a_user_can_delete_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->delete(route('projects.destroy', $project))
                ->assertRedirect(route('projects.index'));
        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function a_user_can_update_a_project_details()
    {
        $project = ProjectFactory::create();

        $attributes = [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(1)
        ];

        $this->actingAs($project->owner)->patch(route('projects.update', $project), $attributes)
            ->assertRedirect(route('projects.show', $project));
        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects.edit', $project))->assertOk();

        $this->get(route('projects.show', $project))
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description']);
    }

    /** @test */
    public function a_user_can_update_a_project_general_notes()
    {
        $project = ProjectFactory::create();

        $attributes = [
            'notes' => $this->faker->sentence(4)
        ];

        $this->actingAs($project->owner)->patch(route('projects.update', $project), $attributes);
        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_view_his_projects()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->get(route('projects.show', $project))
            ->assertSee($project['title'])
            ->assertSee($project['description']);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->get(route('projects.show', $project))->assertForbidden();
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->patch(route('projects.update', $project), ['notes' => 'test notes'])->assertForbidden();
    }

    /** @test */
    public function an_authenticated_user_cannot_delete_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->delete(route('projects.destroy', $project))->assertForbidden();
    }
}
