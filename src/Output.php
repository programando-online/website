<?php

namespace App;

abstract class Output
{
    public static function save(string $filename, string $data)
    {
        $file = new \SplFileObject($filename, "w");
        $file->fwrite($data);
    }

    public static function clear(string $directory)
    {
        $dir = new \SplFileInfo($directory);
        if($dir->isDir()){
            $recursive_directory = new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS);
            $iterator = new \RecursiveIteratorIterator($recursive_directory, \RecursiveIteratorIterator::CHILD_FIRST);
            foreach($iterator as $file){
                if($file->isFile()){
                    unlink($file->getPathname());
                }else{
                    rmdir($file->getPathname());
                }
            }
        }
    }

    public static function create_dir(string $directory)
    {
        $dir = new \SplFileInfo($directory);
        if(!$dir->isDir()){
            mkdir($dir->getPathname());
        }
    }
}