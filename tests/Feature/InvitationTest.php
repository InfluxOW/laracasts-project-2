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
    public function a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $user = $this->user();
        $project->invite($user);

        $data = ['body' => 'test body'];
        $this->actingAs($user)->post(route('projects.tasks.store', $project), $data);
        $this->assertDatabaseHas('tasks', $data);
    }
}
