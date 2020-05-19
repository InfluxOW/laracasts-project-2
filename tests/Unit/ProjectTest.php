<?php

namespace Tests\Unit;

use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $project = ProjectFactory::create();

        $this->assertInstanceOf('App\User', $project->owner);
    }

    /** @test */
    public function it_can_add_a_task()
    {
        $project = ProjectFactory::create();
        $data = ['body' => 'test task'];
        $task = $project->addTask($data);

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }

    /** @test */
    public function it_can_invite_a_user()
    {
        $project = ProjectFactory::create();
        $user = $this->user();
        $project->invite($user);

        $this->assertTrue($project->members->contains($user));
    }
}
