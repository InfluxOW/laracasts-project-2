<?php

namespace Tests\Unit;

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
}
