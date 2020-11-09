<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {   
        $fileName = $className;
        $fileName = str_replace(['app', '\\'], [ROOT_DIR, DIRECTORY_SEPARATOR], ($fileName)) . '.php';
        //echo $fileName . '</br>';
        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}    
