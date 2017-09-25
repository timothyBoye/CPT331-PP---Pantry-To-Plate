<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

class BaseTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate', ['--database' => 'sqlite_testing']);
    }


    public function tearDown()
    {
        Artisan::call('migrate:rollback', ['--database' => 'sqlite_testing']);
        parent::tearDown();
    }
}