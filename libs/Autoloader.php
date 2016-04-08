<?php

//  autoloading function
function load($class_name)
{
   
    if (!is_string($class_name))
        {
             throw new Exception('In method "load" argument must be string');
        }

    $array_loadPath = array
   (
        'libs/',
        'models/',
    );
    foreach ($array_loadPath as $path) 
    {
        $includedFile = $path . $class_name . '.php';
        if (is_file($includedFile)) 
        {
            require_once $includedFile;
        }
    }
}
