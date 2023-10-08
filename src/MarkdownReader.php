<?php

namespace App;

abstract class MarkdownReader
{
    public static function read(string $filename)
    {
        $fileInfo = new \SplFileInfo($filename);
        if($fileInfo->isFile()){
            if(strtolower($fileInfo->getExtension()) === "md"){
                $textContent = "";
                $fileObject = $fileInfo->openFile('r');
                while(!$fileObject->eof()){
                    $textContent .= $fileObject->fgets();
                }
                return $textContent;
            }
        }
        return "";
    }
}