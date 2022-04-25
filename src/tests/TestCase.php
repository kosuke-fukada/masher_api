<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        if (!RefreshDatabaseState::$migrated) {
            $this->artisan('migrate:refresh');
            $this->artisan('db:seed');
            RefreshDatabaseState::$migrated = true;
        }
    }
}
