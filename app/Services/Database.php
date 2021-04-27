<?php


namespace App\Services;


class Database
{
    private static $instance;
    private \PDO $connection;

    public $time;

    private function __construct()
    {
        $settingsFile = BASE_PATH . '/config/database.php';

        if (file_exists($settingsFile)) {
            $settings = require_once $settingsFile;

            $db_host = $settings['DB_HOST'];
            $db_port = $settings['DB_PORT'];
            $db_name = $settings['DB_NAME'];
            $db_user = $settings['DB_USER'];
            $db_pass = $settings['DB_PASS'];
            $flags = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];

            $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4";

            $this->connection = new \PDO($dsn, $db_user, $db_pass, $flags);

            $this->time = microtime(true);
        } else {
            throw new \Exception("Database settings file not found in <$settingsFile>");
        }
    }

    public static function getConnection(): \PDO
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance->connection;
    }
}