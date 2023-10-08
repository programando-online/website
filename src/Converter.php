<?php
namespace App;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

class Converter
{
    private Environment $environment;
    private MarkdownConverter $converter;
    public function __construct(array $config = [])
    {
        $this->environment = new Environment($config);
        $this->environment->addExtension(new CommonMarkCoreExtension());
        $this->environment->addExtension(new FrontMatterExtension());
        $this->converter = new MarkdownConverter($this->environment);
    }
    public function read(string $markdown)
    {
        try {
            $response = [];
            $result = $this->converter->convert($markdown);
            if($result instanceof RenderedContentWithFrontMatter) {
                $response['header'] = $result->getFrontMatter();
            }
            $response['body'] = $result->getContent();
            return $response;    
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}