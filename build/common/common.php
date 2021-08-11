<?php

use MillionMile\GetEnv\Env;

function env($name,$default = null)
{
    Env::loadFile('.env');
    return   Env::get($name, $default);
}
