<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_owners_may_not_invite_users()
    {
        $project = ProjectFactory::create();

        $john = $this->user();
        $sally = $this->user();

        $this->actingAs($john)
            ->post(route('projects.invitations.store', $project), ['email' => $sally->email])
            ->assertForbidden();

        $project->invite($john);

        $this->actingAs($john)
            ->post(route('projects.invitations.store', $project), ['email' => $sally->email])
            ->assertForbidden();
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = ProjectFactory::create();
        $user = $this->user();

        $this->actingAs($project->owner)
            ->post(route('projects.invitations.store', $project), ['email' => $user->email])
            ->assertRedirect(route('projects.show', $project));

        $this->assertTrue($project->members->contains($user));
    }

    /** @test */
    public function the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)
            ->post(route('projects.invitations.store', $project), ['email' => 'invalidemail@test.com'])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function invited_user_may_update_project_details()
    {
        $project = ProjectFactory::create();

        $user = $this->user();
        $project->invite($user);

        $data = ['body' => 'test body'];
        $this->actingAs($user)->post(route('projects.tasks.store', $project), $data);
        $this->assertDatabaseHas('tasks', $data);
    }
}
