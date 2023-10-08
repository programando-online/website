<?php

namespace App;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private array $content;
    public function __construct()
    {
        try {
            $this->content = Yaml::parseFile('./app/config.yml');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get(string $section, string $key)
    {
        if(array_key_exists($section, $this->content)){
            if(array_key_exists($key, $this->content[$section])){
                return $this->content[$section][$key];
            }
        }
        return '';
    }
}