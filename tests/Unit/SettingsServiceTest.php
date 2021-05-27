<?php


namespace Tests\Unit;


use App\Services\Settings;
use Tests\TestCase;

class SettingsServiceTest extends TestCase
{
    public function test_one_key()
    {
        $settings = new Settings();
        $result = $settings->key('name');

        $this->assertSame($_ENV['APP_NAME'], $result);
    }
}