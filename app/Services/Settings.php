<?php

namespace App\Services;

class Settings implements SettingsInterface
{
    private static ?Settings $instance = null;
    private array $settings;

    private function __clone() {}

    /**
     * Settings constructor.
     */
    private function __construct()
    {
        $settingsFile = BASE_PATH . '/config/settings.php';

        if (file_exists($settingsFile)) {
            $this->settings = require_once $settingsFile;
        } else {
            throw new \Exception("Application settings file not found in <$settingsFile>");
        }
    }

    /**
     * Returns an instance of Settings object. (Singleton)
     *
     * @return Settings|null
     */
    public static function instance(): ?Settings
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
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