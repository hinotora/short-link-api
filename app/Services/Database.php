<?php


namespace App\Services;


class Database
{
    private static $instance;
    private \PDO $connection;

    private function __construct()
    {
        $settingsFile = BASE_PATH . '/config/database.php';

        if (file_exists($settingsFile)) {
            $settings = require_once $settingsFile;

            $db_driver = $settings['DB_DRIVER'];
            $db_host = $settings['DB_HOST'];
            $db_port = $settings['DB_PORT'];
            $db_name = $settings['DB_NAME'];
            $db_user = $settings['DB_USER'];
            $db_pass = $settings['DB_PASS'];
            $flags = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];

            $dsn = "$db_driver:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4";

            try {
                $this->connection = new \PDO($dsn, $db_user, $db_pass, $flags);
            }
            catch (\PDOException $e) {
                throw new \PDOException('Unable to connect with database');
            }

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