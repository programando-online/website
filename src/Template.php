<?php

namespace App;

use Nette\DirectoryNotFoundException;
use Nette\FileNotFoundException;
use SplFileInfo;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Template
{
    private string $path;
    private FilesystemLoader $loader;
    private Environment $environment;

    public function __construct(string $templatePath)
    {
        $testDir = new SplFileInfo($templatePath);
        if ($testDir->isDir()) {
            $this->path = $templatePath;
            $this->loader = new FilesystemLoader($this->path);
            $this->environment = new Environment($this->loader, ['autoescape' => false]);
        }else{
            throw new DirectoryNotFoundException();
        }

    }

    public function render(string $template, array $data)
    {
        $filename = $this->path . "/" . $template;
        $file = new SplFileInfo($filename);
        if($file->isFile()){
            $template = $this->environment->load($template);
            return $template->render($data);
        }else{
            throw new FileNotFoundException();
        }
    }
}