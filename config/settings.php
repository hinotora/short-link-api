<?php

return  [
    'name' => environ('APP_NAME', 'SLIM REST API'),
    'ver' => environ('APP_VER', '0.0.0'),
    'url' => environ('APP_URL', 'localhost'),
    'env' => environ('APP_ENV', 'testing'),
];