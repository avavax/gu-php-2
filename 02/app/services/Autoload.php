<?php

namespace App\Services;

class Autoload
{
    private $dir = [
      'app/models',  'app/services', 'app/traits', 
    ];

    public function loadClass($className)
    {
        if (mb_strrpos($className, '\\')) {
            $className = mb_substr($className, mb_strrpos($className, '\\') + 1);
        }

        //var_dump($className);

        foreach ($this->dir as $dir)
        {
            $file = $_SERVER['DOCUMENT_ROOT'] . "/../{$dir}/{$className}.php";

            if (file_exists($file)) {
                include $file;
                break;
            }

        }
    }

}


