<?php

namespace App;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private array $content;
    public function __construct($isLocal = false)
    {
        try {
            $this->content = Yaml::parseFile('./app/config.yml');
            if($isLocal){
                $this->content['site']['url'] = "http://localhost:4000";
            }
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