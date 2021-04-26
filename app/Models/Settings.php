<?php

namespace App\Models;

class Settings
{
    private static $settings = null;

    private function __construct() { }
    private function __clone() { }

    public static function get(string $key = null)
    {
        if (is_null(self::$settings)) {
            $settings_file = BASE_PATH . '/config/app.php';

            if (file_exists($settings_file)) {
                self::$settings = require_once $settings_file;
            } else {
                throw new \Exception("Application config file not found in $settings_file");
            }
        }

        if ($key == null) {
            return self::$settings;
        } else {
            return self::$settings[$key];
        }
    }
}