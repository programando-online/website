<?php

namespace App;
use Cocur\Slugify\Slugify;

class BlogObject
{
    public string $title; 
    public string $slug;
    public string $content;
    public string $excerpt;
    public array $header; 

    public function __construct(string $title, string $content, array $header = [], int $size = 200)
    {
        $this->title = $title;
        $this->content = $content;
        $this->header = $header;
        $this->slug = (new Slugify())->slugify($title);
        $this->excerpt = substr(trim(preg_replace('/\s\s+/', ' ', strip_tags($content))), 0, $size);
    }
}