<?php


namespace container\interfaces;


use container\Application;
use container\core\ContainerBase;

interface Middlewares
{
    /**
     * 处理中间件
     * @return mixed
     */
    public function handle(Application $app);
}
