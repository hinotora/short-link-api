<?php

return [
    'DB_DRIVER' => environ('DB_DRIVER', 'mysql'),
    'DB_HOST' => environ('DB_HOST', '127.0.0.1'),
    'DB_PORT' => environ('DB_PORT', '3306'),
    'DB_NAME' => environ('DB_NAME', 'test_database'),
    'DB_USER' => environ('DB_USER', 'root'),
    'DB_PASS' => environ('DB_PASS', ''),
];