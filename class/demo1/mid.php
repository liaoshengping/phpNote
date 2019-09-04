<?php
include (__DIR__.'/user.php');

/**
 * @method static user user
 * Class mid
 */
class mid{

    public static function __callStatic($name, $arguments)
    {
        return new $name();
    }
}
