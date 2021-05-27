<?php

namespace Tests\Unit;

use App\Models\Link;
use Tests\TestCase;

class LinkModelTest extends TestCase
{
    public function test_get_all_models()
    {
        $link = new Link($this->app->getContainer());
        $linkArray = $link->all();

        $this->assertIsArray($linkArray);
        $this->assertGreaterThan(0, count($linkArray));
    }
}