<?php

namespace Tests\Unit;

use App\Task;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_subject()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $activity = $project->activities->last();

        $this->assertInstanceOf(Task::class, $activity->subject);
    }

    /** @test */
    public function it_has_a_user()
    {
        $project = ProjectFactory::create();
        $activity = $project->activities->last();

        $this->assertEquals($project->owner, $activity->user);
    }
}
