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