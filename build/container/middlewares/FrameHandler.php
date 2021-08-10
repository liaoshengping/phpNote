<?php


namespace container\middlewares;


use container\Application;
use container\interfaces\Middlewares;

class FrameHandler implements Middlewares
{

    public function handle(Application $app)
    {

        echo "初始化".PHP_EOL;

    }
}
