<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function user()
    {
        return factory('App\User')->create();
    }

    protected function project()
    {
        return factory('App\Project')->create();
    }

    protected function logIn()
    {
        return $this->be($this->user());
    }
}
