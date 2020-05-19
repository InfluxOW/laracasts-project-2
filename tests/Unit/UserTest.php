<?php

namespace Tests\Unit;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_projects()
    {
        $user = $this->user();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_avaliable_projects()
    {
        $project = ProjectFactory::create();
        $john = $project->owner;
        $this->assertCount(1, $john->avaliableProjects()->get());

        // making some projects with members
        $randomProjects = factory(Project::class, 10)->create();
        $randomProjects->map(function ($project) use ($john) {
            $project->invite($john);
        });

        $sally = $this->user();
        $this->assertCount(0, $sally->avaliableProjects()->get());

        $project->invite($sally);
        $this->assertCount(1, $sally->avaliableProjects()->get());
    }
}
