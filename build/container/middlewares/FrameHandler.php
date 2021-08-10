<?php


namespace container\middlewares;


use container\Application;
use container\interfaces\Middlewares;

class FrameHandler implements Middlewares
{

    public function handle(Application $app)
    {
        echo "³õÊ¼»¯¿ò¼Ü".PHP_EOL;

    }
}
