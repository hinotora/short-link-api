<?php


namespace App\Services;


class Database
{
    /**
     * Class instance.
     *
     * @var self
     */
    private static $instance;

    /**
     * PDO connection object.
     *
     * @var \PDO
     */
    private \PDO $connection;

    /**
     * Database constructor.
     * Creates database object.
     *
     * @throws \Exception
     */
    private function __construct()
    {
        $settingsFile = dirname(__DIR__) . '/../config/database.php';

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

            if ($db_driver != 'pgsql') {
                $charset = "charset=utf8mb4";
            } else {
                $charset = "";
            }

            $dsn = "$db_driver:host=$db_host;port=$db_port;dbname=$db_name;".$charset;

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

    /**
     * Singleton database object. Returns PDO object.
     *
     * @return \PDO
     */
    public static function getConnection(): \PDO
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance->connection;
    }
}