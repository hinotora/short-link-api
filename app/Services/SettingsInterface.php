<?php


namespace App\Services;


interface SettingsInterface
{
    public function all();

    public function key(string $key);
}