<?php

namespace App\Services;

class Settings
{
    private array $settings;

    /**
     * Settings constructor.
     */
    public function __construct()
    {
        $settingsFile = BASE_PATH . '/config/settings.php';

        if (file_exists($settingsFile)) {
            $this->settings = require_once $settingsFile;
        } else {
            throw new \Exception("Application settings file not found in <$settingsFile>");
        }
    }

    /**
     * Returns an array of setting values.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->settings;
    }

    /**
     * Returns setting value by key, returns null if not in settings.
     *
     * @param string $key
     * @return mixed
     */
    public function key(string $key): mixed
    {
        if (isset($this->settings[$key])) {
            return $this->settings[$key];
        } else {
            return null;
        }
    }


}