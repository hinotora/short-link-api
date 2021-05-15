<?php

namespace Tests;

use Slim\App;

trait CreatesApplication
{
    protected ?App $app;

    protected function setUp(): void
    {
        $this->app = require __DIR__.'/../app/bootstrap.php';
    }

    protected function tearDown(): void
    {
        $this->app = null;
    }
}