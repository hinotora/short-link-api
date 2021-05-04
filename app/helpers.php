<?php

if (!function_exists('now')) {
    /**
     * Returns current date
     *
     * @return string
     */
    function now(): string
    {
        return date('Y-m-d h:i:s', time());
    }
}

if (!function_exists('parseUrl')) {
    /**
     * Validates given url by regex
     *
     * Return true if valid, false if not
     *
     * @param string $url
     * @return bool
     */
    function parseUrl(string $url): bool
    {
        // TODO: link validator
        return true;
    }
}

if (!function_exists('randomStr')) {
    /**
     * Generates random string
     *
     * @param int $length
     * @return string
     * @throws Exception
     */
    function randomStr(int $length = 16): string {
        $keyspace = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }

        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}

if (!function_exists('appUrl')) {
    /**
     * Generates short link url
     *
     * @param string $url
     * @return string
     */
    function short(string $url): string
    {
        return $_ENV['APP_URL'].$url;
    }
}