<?php


namespace App\Models;

class Database
{
    private static ?\PDO $connection = null;

    public static function get(): \PDO
    {
        if (is_null(self::$connection)) {
            $settings_file = BASE_PATH . '/config/database.php';

            if (file_exists($settings_file)) {
                $settings = require_once $settings_file;

                $db_host = $settings['DB_HOST'];
                $db_port = $settings['DB_PORT'];
                $db_name = $settings['DB_NAME'];
                $db_user = $settings['DB_USER'];
                $db_pass = $settings['DB_PASS'];

                $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4";

                self::$connection = new \PDO($dsn, $db_user, $db_pass);
            } else {
                throw new \Exception("Database config file not found in $settings_file");
            }
        }

        return self::$connection;
    }
}