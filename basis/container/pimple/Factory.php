<?php
include ("../../../vendor/autoload.php");
/**
 * Class Factory
 * @method static \user\User user($config=[])
 */
class Factory{

    public static function __callStatic($name, $arguments)
    {
       $name = $name.DIRECTORY_SEPARATOR.ucfirst($name);
        return new $name();
    }
}
