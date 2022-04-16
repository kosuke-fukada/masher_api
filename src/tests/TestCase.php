<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    static $testInitialized = false;

    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        if (!self::$testInitialized) {
            Artisan::call('migrate');
            self::$testInitialized = true;
        }
    }
}
