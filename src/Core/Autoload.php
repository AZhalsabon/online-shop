<?php

namespace Core;

class Autoload
{
    public static function registrate($rootPath)
    {
        spl_autoload_register(function (string $className) use ($rootPath) {

            $handlePath = str_replace('\\', '/',$className);
            $path = $rootPath . $handlePath . ".php";

            if (file_exists($path)){
                require_once $path;

                return true;

            }
            return false;
        });
    }

}